package com.database2.android.studentinfo;

import android.os.Bundle;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.util.Log;

import androidx.fragment.app.Fragment;
import androidx.navigation.fragment.NavHostFragment;


import com.database2.android.studentinfo.databinding.FragmentLoginBinding;

import java.io.BufferedReader;
import java.io.InputStreamReader;
import java.io.OutputStream;
import java.net.HttpURLConnection;
import java.net.URL;
import java.net.URLEncoder;
import java.util.concurrent.ExecutorService;
import java.util.concurrent.Executors;

public class loginFragment extends Fragment {

    private static final String LOGIN_URL = "http://10.0.2.2/phase2/login.php";

    private FragmentLoginBinding binding;
    private final ExecutorService executor = Executors.newSingleThreadExecutor();

    @Override
    public View onCreateView(LayoutInflater inflater, ViewGroup container,
                             Bundle savedInstanceState) {
        binding = FragmentLoginBinding.inflate(inflater, container, false);

        binding.loginButton.setOnClickListener(v -> sendRequest("log_btn"));
        binding.forgetUsernameButton.setOnClickListener(v -> sendRequest("forgot_user_btn"));
        binding.forgetPasswordButton.setOnClickListener(v -> sendRequest("forgot_pass_btn"));

        return binding.getRoot();
    }

    @Override
    public void onDestroyView() {
        super.onDestroyView();
        binding = null;
    }

    private void sendRequest(String buttonKey) {
        // Guard against binding being null if somehow called after destroy
        if (binding == null) return;

        String username = binding.usernameInput.getText().toString().trim();
        String password = binding.passwordInput.getText().toString().trim();
        String role;
        if (binding.studentRadioButton.isChecked()) {
            role = "STUDENT";
        } else if (binding.instructorRadioButton.isChecked()) {
            role = "INSTRUCTOR";
        } else if (binding.adminRadioButton.isChecked()) {
            role = "ADMIN";
        } else {
            requireActivity().runOnUiThread(() -> binding.resultText.setText("Please select a user type."));
            return;
        }

        executor.execute(() -> {
            String response = postToPhp(username, password, role, buttonKey);
            if (getActivity() != null) {
                requireActivity().runOnUiThread(() -> {
                    if (binding != null) binding.resultText.setText(response);
                });
            }
        });
    }

    private String postToPhp(String username, String password, String role, String buttonKey) {
        try {
            URL url = new URL(LOGIN_URL);
            HttpURLConnection conn = (HttpURLConnection) url.openConnection();
            conn.setRequestMethod("POST");
            conn.setDoOutput(true);
            conn.setConnectTimeout(5000);
            conn.setReadTimeout(5000);

            String body = "user_input="      + URLEncoder.encode(username,  "UTF-8") +
                    "&password_input=" + URLEncoder.encode(password,  "UTF-8") +
                    "&roleSelector="   + URLEncoder.encode(role,      "UTF-8") +
                    "&"                + URLEncoder.encode(buttonKey, "UTF-8") + "=1";

            try (OutputStream os = conn.getOutputStream()) {
                os.write(body.getBytes("UTF-8"));
            }

            BufferedReader reader = new BufferedReader(
                    new InputStreamReader(conn.getInputStream()));
            StringBuilder sb = new StringBuilder();
            String line;
            while ((line = reader.readLine()) != null) sb.append(line);
            reader.close();

            NavHostFragment.findNavController(loginFragment.this).navigate(R.id.action_loginFragment_to_mainMenuFragment);

            return sb.toString().replaceAll("<[^>]+>", "").trim();

        } catch (Exception e) {
            return "Connection error: " + e.getMessage();
        }
    }
}