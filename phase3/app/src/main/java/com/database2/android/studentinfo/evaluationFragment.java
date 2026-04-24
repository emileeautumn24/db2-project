package com.database2.android.studentinfo;

import android.os.Bundle;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.util.Log;

import androidx.fragment.app.Fragment;


import com.database2.android.studentinfo.databinding.FragmentEvaluationBinding;

import java.io.BufferedReader;
import java.io.InputStreamReader;
import java.io.OutputStream;
import java.net.HttpURLConnection;
import java.net.URL;
import java.net.URLEncoder;
import java.util.concurrent.ExecutorService;
import java.util.concurrent.Executors;


public class evaluationFragment extends Fragment {

    private static final String EVALUATION_URL = "http://10.0.2.2/phase2/course_evaluation.php";

    private FragmentEvaluationBinding binding;
    private final ExecutorService executor = Executors.newSingleThreadExecutor();

    @Override
    public View onCreateView(LayoutInflater inflater, ViewGroup container,
                             Bundle savedInstanceState) {
        binding = FragmentEvaluationBinding.inflate(inflater, container, false);

        Bundle args = getArguments();
        String username = "";
        if (args != null) {
            username = args.getString("username", "");
        }

        final String studentId = username;

        binding.submitButton.setOnClickListener(v -> {
            String courseId  = binding.courseIdInput.getText().toString().trim();
            String sectionId = binding.sectionIdInput.getText().toString().trim();
            String semester  = binding.semesterInput.getText().toString().trim();
            String year      = binding.yearInput.getText().toString().trim();
            String comments  = binding.commentInput.getText().toString().trim();

            // Map RadioButton selection to a numeric rating string
            int checkedId = binding.radioGroup.getCheckedRadioButtonId();
            String rating = "";
            if      (checkedId == R.id.oneRadioButton)   rating = "1";
            else if (checkedId == R.id.twoRadioButton)   rating = "2";
            else if (checkedId == R.id.threeRadioButton) rating = "3";
            else if (checkedId == R.id.fourRadioButton)  rating = "4";
            else if (checkedId == R.id.fiveRadioButton)  rating = "5";

            if (studentId.isEmpty() || courseId.isEmpty() || sectionId.isEmpty()
                    || semester.isEmpty() || year.isEmpty() || rating.isEmpty()) {
                binding.resultText.setText("Please fill in all required fields.");
                return;
            }

            sendRequest(studentId, courseId, sectionId, semester, year, rating, comments);
        });

        return binding.getRoot();
    }

    @Override
    public void onDestroyView() {
        super.onDestroyView();
        binding = null;
    }

    private void sendRequest(String studentId, String courseId, String sectionId,
                             String semester, String year, String rating, String comments) {
        // Guard against binding being null if somehow called after destroy
        if (binding == null) return;

        executor.execute(() -> {
            String response = postToPhp(studentId, courseId, sectionId, semester, year, rating, comments);
            if (getActivity() != null) {
                requireActivity().runOnUiThread(() -> {
                    if (binding != null) binding.resultText.setText(response);
                });
            }
        });
    }

    private String postToPhp(String studentId, String courseId, String sectionId,
                             String semester, String year, String rating, String comments) {
        try {
            URL url = new URL(EVALUATION_URL);
            HttpURLConnection conn = (HttpURLConnection) url.openConnection();
            conn.setRequestMethod("POST");
            conn.setDoOutput(true);
            conn.setConnectTimeout(5000);
            conn.setReadTimeout(5000);

            String body = "student_id="        + URLEncoder.encode(studentId,  "UTF-8")
                    + "&course_id="        + URLEncoder.encode(courseId,   "UTF-8")
                    + "&section_id="       + URLEncoder.encode(sectionId,  "UTF-8")
                    + "&semesterSelector=" + URLEncoder.encode(semester,   "UTF-8")
                    + "&year_id="          + URLEncoder.encode(year,       "UTF-8")
                    + "&rateSelector="     + URLEncoder.encode(rating,     "UTF-8")
                    + "&comments="         + URLEncoder.encode(comments,   "UTF-8");

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
                    .replaceAll("(?i)</h[1-6]>", "\n")   // convert closing heading tags to newline
                    .replaceAll("(?i)<br\\s*/?>", "\n")   // convert <br> to newline
                    .replaceAll("<[^>]+>", "")             // strip remaining tags
                    .trim();

        } catch (Exception e) {
            return "Connection error: " + e.getMessage();
        }
    }
}