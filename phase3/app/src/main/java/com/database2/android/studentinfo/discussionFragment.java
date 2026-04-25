package com.database2.android.studentinfo;

import android.os.Bundle;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.Button;
import android.widget.EditText;
import android.widget.TextView;

import androidx.fragment.app.Fragment;
import androidx.navigation.fragment.NavHostFragment;

import java.io.BufferedReader;
import java.io.InputStreamReader;
import java.io.OutputStream;
import java.net.HttpURLConnection;
import java.net.URL;
import java.net.URLEncoder;
import java.util.concurrent.ExecutorService;
import java.util.concurrent.Executors;

public class discussionFragment extends Fragment {

    private static final String DISCUSSION_URL = "http://10.0.2.2/phase2/discussion_board.php";

    private EditText discCourseIdInput, discSectionIdInput, discSemesterInput,
            discYearInput, postContentInput, deleteStudentIdInput;
    private TextView discussionPostsText, discResultText;
    private final ExecutorService executor = Executors.newSingleThreadExecutor();

    private String username = "";
    private String role = "STUDENT"; // "STUDENT", "TA", or "GRADER"

    @Override
    public View onCreateView(LayoutInflater inflater, ViewGroup container,
                             Bundle savedInstanceState) {
        View view = inflater.inflate(R.layout.fragment_discussion, container, false);

        discCourseIdInput    = view.findViewById(R.id.discCourseIdInput);
        discSectionIdInput   = view.findViewById(R.id.discSectionIdInput);
        discSemesterInput    = view.findViewById(R.id.discSemesterInput);
        discYearInput        = view.findViewById(R.id.discYearInput);
        postContentInput     = view.findViewById(R.id.postContentInput);
        deleteStudentIdInput = view.findViewById(R.id.deleteStudentIdInput);
        discussionPostsText  = view.findViewById(R.id.discussionPostsText);
        discResultText       = view.findViewById(R.id.discResultText);

        // Get username and role passed from main menu
        Bundle args = getArguments();
        if (args != null) {
            username = args.getString("username", "");
            role     = args.getString("role", "STUDENT");
        }

        // Hide delete fields if user is not TA or GRADER
        Button deletePostButton = view.findViewById(R.id.deletePostButton);
        if (!role.equals("TA") && !role.equals("GRADER")) {
            deleteStudentIdInput.setVisibility(View.GONE);
            deletePostButton.setVisibility(View.GONE);
        }

        view.findViewById(R.id.postButton).setOnClickListener(v -> postMessage());
        deletePostButton.setOnClickListener(v -> deletePost());
        view.findViewById(R.id.discBackButton).setOnClickListener(v ->
                NavHostFragment.findNavController(discussionFragment.this).popBackStack());

        return view;
    }

    private void postMessage() {
        String courseId  = discCourseIdInput.getText().toString().trim();
        String sectionId = discSectionIdInput.getText().toString().trim();
        String semester  = discSemesterInput.getText().toString().trim();
        String year      = discYearInput.getText().toString().trim();
        String postText  = postContentInput.getText().toString().trim();

        if (courseId.isEmpty() || sectionId.isEmpty() || semester.isEmpty()
                || year.isEmpty() || postText.isEmpty()) {
            discResultText.setText("Please fill in all fields and write a post.");
            return;
        }

        discResultText.setText("Posting...");
        executor.execute(() -> {
            String response = postToPhp(username, courseId, sectionId, semester, year,
                    postText, "", role, "post_btn");
            if (getActivity() != null) {
                requireActivity().runOnUiThread(() -> {
                    discResultText.setText("Posted successfully!");
                    discussionPostsText.setText(response);
                    postContentInput.setText("");
                });
            }
        });
    }

    private void deletePost() {
        String courseId        = discCourseIdInput.getText().toString().trim();
        String sectionId       = discSectionIdInput.getText().toString().trim();
        String semester        = discSemesterInput.getText().toString().trim();
        String year            = discYearInput.getText().toString().trim();
        String deleteStudentId = deleteStudentIdInput.getText().toString().trim();

        if (courseId.isEmpty() || sectionId.isEmpty() || semester.isEmpty()
                || year.isEmpty() || deleteStudentId.isEmpty()) {
            discResultText.setText("Please fill in all course fields and the student ID to delete.");
            return;
        }

        discResultText.setText("Deleting...");
        executor.execute(() -> {
            String response = postToPhp(username, courseId, sectionId, semester, year,
                    "", deleteStudentId, role, "del_btn");
            if (getActivity() != null) {
                requireActivity().runOnUiThread(() -> {
                    discResultText.setText("Post deleted.");
                    discussionPostsText.setText(response);
                    deleteStudentIdInput.setText("");
                });
            }
        });
    }

    private String postToPhp(String studentId, String courseId, String sectionId,
                             String semester, String year, String postText,
                             String deleteStudentId, String type, String buttonKey) {
        try {
            URL url = new URL(DISCUSSION_URL);
            HttpURLConnection conn = (HttpURLConnection) url.openConnection();
            conn.setRequestMethod("POST");
            conn.setDoOutput(true);
            conn.setConnectTimeout(5000);
            conn.setReadTimeout(5000);

            String body = "student_id="        + URLEncoder.encode(studentId,       "UTF-8") +
                    "&course_id="         + URLEncoder.encode(courseId,        "UTF-8") +
                    "&section_id="        + URLEncoder.encode(sectionId,       "UTF-8") +
                    "&semesterSelector="  + URLEncoder.encode(semester,        "UTF-8") +
                    "&year_num="          + URLEncoder.encode(year,            "UTF-8") +
                    "&post_text="         + URLEncoder.encode(postText,        "UTF-8") +
                    "&student_delete_id=" + URLEncoder.encode(deleteStudentId, "UTF-8") +
                    "&typeSelector="      + URLEncoder.encode(type,            "UTF-8") +
                    "&"                   + buttonKey + "=1";

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
