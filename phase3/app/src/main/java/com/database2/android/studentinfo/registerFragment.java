package com.database2.android.studentinfo;

import android.os.Bundle;

import androidx.fragment.app.Fragment;
import androidx.navigation.fragment.NavHostFragment;

import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;

import android.widget.Button;
import android.widget.EditText;
import android.widget.TextView;

import java.io.BufferedReader;
import java.io.InputStreamReader;
import java.io.OutputStream;
import java.net.HttpURLConnection;
import java.net.URL;
import java.net.URLEncoder;
import java.util.concurrent.ExecutorService;
import java.util.concurrent.Executors;


public class registerFragment extends Fragment {

    private static final String REGISTER_URL = "http://10.0.2.2/phase2/browse_register.php";

    private EditText semesterInput, yearInput, courseIdInput, sectionIdInput;
    private TextView coursesText, enrollResultText;
    private final ExecutorService executor = Executors.newSingleThreadExecutor();
    private String username = "";

    @Override
    public View onCreateView(LayoutInflater inflater, ViewGroup container,
                             Bundle savedInstanceState) {
        // Inflate the layout for this fragment
        View view = inflater.inflate(R.layout.fragment_register, container, false);

        semesterInput     = view.findViewById(R.id.semesterInput);
        yearInput         = view.findViewById(R.id.yearInput);
        courseIdInput     = view.findViewById(R.id.courseIdInput);
        sectionIdInput    = view.findViewById(R.id.sectionIdInput);
        coursesText       = view.findViewById(R.id.coursesText);
        enrollResultText  = view.findViewById(R.id.enrollResultText);

        // Get username passed from main menu
        Bundle args = getArguments();
        if (args != null) {
            username = args.getString("username", "");
        }

        view.findViewById(R.id.viewCoursesButton).setOnClickListener(v -> viewCourses());
        view.findViewById(R.id.enrollButton).setOnClickListener(v -> enroll());
        view.findViewById(R.id.backButton).setOnClickListener(v ->
                NavHostFragment.findNavController(registerFragment.this).popBackStack());

        return view;
    }

    private void viewCourses() {
        String semester = semesterInput.getText().toString().trim();
        String year     = yearInput.getText().toString().trim();

        if (semester.isEmpty() || year.isEmpty()) {
            coursesText.setText("Please enter both semester and year.");
            return;
        }

        coursesText.setText("Loading");
        executor.execute(() -> {
            String response = postToPhp(username, "", "", semester, year, "view_btn");
            if (getActivity() != null) {
                requireActivity().runOnUiThread(() -> coursesText.setText(response));
            }
        });
    }

    private void enroll() {
        String semester  = semesterInput.getText().toString().trim();
        String year      = yearInput.getText().toString().trim();
        String courseId  = courseIdInput.getText().toString().trim();
        String sectionId = sectionIdInput.getText().toString().trim();

        if (semester.isEmpty() || year.isEmpty() || courseId.isEmpty() || sectionId.isEmpty()) {
            enrollResultText.setText("Please fill in all fields.");
            return;
        }

        enrollResultText.setText("Registering");
        executor.execute(() -> {
            String response = postToPhp(username, courseId, sectionId, semester, year, "enroll_btn");
            if (getActivity() != null) {
                requireActivity().runOnUiThread(() -> enrollResultText.setText(response));
            }
        });
    }

    private String postToPhp(String studentId, String courseId, String sectionId,
                             String semester, String year, String buttonKey) {
        try {
            URL url = new URL(REGISTER_URL);
            HttpURLConnection conn = (HttpURLConnection) url.openConnection();
            conn.setRequestMethod("POST");
            conn.setDoOutput(true);
            conn.setConnectTimeout(5000);
            conn.setReadTimeout(5000);

            String body = "student_id="       + URLEncoder.encode(studentId,  "UTF-8") +
                    "&course_id="        + URLEncoder.encode(courseId,   "UTF-8") +
                    "&section_id="       + URLEncoder.encode(sectionId,  "UTF-8") +
                    "&semesterSelector=" + URLEncoder.encode(semester,   "UTF-8") +
                    "&year_id="          + URLEncoder.encode(year,       "UTF-8") +
                    "&"                  + URLEncoder.encode(buttonKey,  "UTF-8") + "=1";

            try (OutputStream os = conn.getOutputStream()) {
                os.write(body.getBytes("UTF-8"));
            }

            BufferedReader reader = new BufferedReader(
                    new InputStreamReader(conn.getInputStream()));
            StringBuilder sb = new StringBuilder();
            String line;
            while ((line = reader.readLine()) != null) sb.append(line);
            reader.close();

            return sb.toString()
                    .replaceAll("(?i)<br\\s*/?>", "\n")
                    .replaceAll("<[^>]+>", "")
                    .trim();

        } catch (Exception e) {
            return "Connection error: " + e.getMessage();
        }
    }
}