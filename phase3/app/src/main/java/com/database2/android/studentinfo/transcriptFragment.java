package com.database2.android.studentinfo;

import android.os.Bundle;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.util.Log;

import androidx.fragment.app.Fragment;
import androidx.navigation.fragment.NavHostFragment;


import com.database2.android.studentinfo.databinding.FragmentTranscriptBinding;

import java.io.BufferedReader;
import java.io.InputStreamReader;
import java.io.OutputStream;
import java.net.HttpURLConnection;
import java.net.URL;
import java.net.URLEncoder;
import java.util.concurrent.ExecutorService;
import java.util.concurrent.Executors;

public class transcriptFragment extends Fragment {

    private static final String TRANSCRIPT_URL = "http://10.0.2.2/phase2/student_transcript.php";

    private FragmentTranscriptBinding binding;
    private final ExecutorService executor = Executors.newSingleThreadExecutor();

    @Override
    public View onCreateView(LayoutInflater inflater, ViewGroup container,
                             Bundle savedInstanceState) {
        binding = FragmentTranscriptBinding.inflate(inflater, container, false);
        binding.backButton.setOnClickListener(v ->
                NavHostFragment.findNavController(transcriptFragment.this).popBackStack());

        Bundle args = getArguments();
        if (args != null) {
            String username = args.getString("username", "");
            String role = args.getString("role", "");
            if (role.equals("STUDENT")) {
                sendRequest(username);
            } else {
                binding.transcript.setText("Only students can see their transcript.");
            }
        }

        return binding.getRoot();
    }

    @Override
    public void onDestroyView() {
        super.onDestroyView();
        binding = null;
    }

    private void sendRequest(String username) {
        // Guard against binding being null if somehow called after destroy
        if (binding == null) return;

        executor.execute(() -> {
            String response = postToPhp(username);
            if (getActivity() != null) {
                requireActivity().runOnUiThread(() -> {
                    if (binding != null) binding.transcript.setText(response);
                });
            }
        });
    }

    private String postToPhp(String username) {
        try {
            URL url = new URL(TRANSCRIPT_URL);
            HttpURLConnection conn = (HttpURLConnection) url.openConnection();
            conn.setRequestMethod("POST");
            conn.setDoOutput(true);
            conn.setConnectTimeout(5000);
            conn.setReadTimeout(5000);

            String body = "student_id="      + URLEncoder.encode(username,  "UTF-8");

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
                    .replaceAll("(?i)<br\\s*/?>", "\n")  // convert <br> to newline first
                    .replaceAll("<[^>]+>", "")            // then strip remaining tags
                    .trim();

        } catch (Exception e) {
            return "Connection error: " + e.getMessage();
        }
    }
}