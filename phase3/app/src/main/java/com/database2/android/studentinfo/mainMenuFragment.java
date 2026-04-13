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

    @Override
    public View onCreateView(LayoutInflater inflater, ViewGroup container,
                             Bundle savedInstanceState) {
        // Inflate the layout for this fragment
        binding = FragmentMainMenuBinding.inflate(inflater, container, false);
        binding.discussionButton.setOnClickListener(v -> NavHostFragment.findNavController(mainMenuFragment.this).navigate(R.id.action_mainMenuFragment_to_discussionFragment));
        binding.evaluationButton.setOnClickListener(v -> NavHostFragment.findNavController(mainMenuFragment.this).navigate(R.id.action_mainMenuFragment_to_evaluationFragment));
        binding.registerButton.setOnClickListener(v -> NavHostFragment.findNavController(mainMenuFragment.this).navigate(R.id.action_mainMenuFragment_to_registerFragment));
        binding.transcriptButton.setOnClickListener(v -> NavHostFragment.findNavController(mainMenuFragment.this).navigate(R.id.action_mainMenuFragment_to_transcriptFragment));
        return binding.getRoot();
    }

    @Override
    public void onDestroyView() {
        super.onDestroyView();
        binding = null;
    }
}