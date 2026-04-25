package com.database2.android.studentinfo;

import android.os.Bundle;

import androidx.fragment.app.Fragment;
import androidx.navigation.fragment.NavHostFragment;

import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;

import com.database2.android.studentinfo.databinding.FragmentMainMenuBinding;

public class mainMenuFragment extends Fragment {

    private FragmentMainMenuBinding binding;
    private String username = "";  // ADD
    private String role = "";      // ADD

    @Override
    public View onCreateView(LayoutInflater inflater, ViewGroup container,
                             Bundle savedInstanceState) {
        // Inflate the layout for this fragment
        binding = FragmentMainMenuBinding.inflate(inflater, container, false);

        Bundle args = getArguments();
        if (args != null) {
            username = args.getString("username", "");  // no "String" prefix
            role = args.getString("role", "");           // no "String" prefix
            binding.resultText.setText(String.format("Welcome, %s (%s)", username, role));
        }

        binding.discussionButton.setOnClickListener(v -> {
            Bundle discussionArgs = new Bundle();
            discussionArgs.putString("username", username);
            discussionArgs.putString("role", role);
            NavHostFragment.findNavController(mainMenuFragment.this)
                    .navigate(R.id.action_mainMenuFragment_to_discussionFragment, discussionArgs);
        });
        binding.evaluationButton.setOnClickListener(v -> {
            Bundle evaluationArgs = new Bundle();
            evaluationArgs.putString("username", username);
            evaluationArgs.putString("role", role);
            NavHostFragment.findNavController(mainMenuFragment.this)
                    .navigate(R.id.action_mainMenuFragment_to_evaluationFragment, evaluationArgs);
        });

        binding.registerButton.setOnClickListener(v -> {
            Bundle registerArgs = new Bundle();
            registerArgs.putString("username", username);
            NavHostFragment.findNavController(mainMenuFragment.this)
                    .navigate(R.id.action_mainMenuFragment_to_registerFragment, registerArgs);
        });

        binding.transcriptButton.setOnClickListener(v -> {
            Bundle transcriptArgs = new Bundle();
            transcriptArgs.putString("username", username);
            transcriptArgs.putString("role", role);
            NavHostFragment.findNavController(mainMenuFragment.this)
                    .navigate(R.id.action_mainMenuFragment_to_transcriptFragment, transcriptArgs);
        });

        return binding.getRoot();
    }

    @Override
    public void onDestroyView() {
        super.onDestroyView();
        binding = null;
    }
}