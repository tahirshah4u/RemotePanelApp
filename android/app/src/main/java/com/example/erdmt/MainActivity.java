package com.example.erdmt;

import androidx.appcompat.app.AppCompatActivity;
import android.os.Bundle;
import android.util.Log;
import android.widget.TextView;

import com.google.firebase.FirebaseApp;
import com.google.firebase.database.*;
import com.google.firebase.firestore.*;
import com.google.firebase.messaging.FirebaseMessaging;

public class MainActivity extends AppCompatActivity {
    TextView statusView;
    DatabaseReference dbRef;
    FirebaseFirestore firestore;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_main);

        statusView = findViewById(R.id.statusView);

        FirebaseApp.initializeApp(this);
        dbRef = FirebaseDatabase.getInstance().getReference("devices/device001/status");
        firestore = FirebaseFirestore.getInstance();

        dbRef.addValueEventListener(new ValueEventListener() {
            @Override
            public void onDataChange(DataSnapshot snapshot) {
                String status = snapshot.getValue(String.class);
                statusView.setText("Status: " + status);
            }
            @Override
            public void onCancelled(DatabaseError error) {
                statusView.setText("Error: " + error.getMessage());
            }
        });

        firestore.collection("logs")
                .whereEqualTo("device", "device001")
                .addSnapshotListener((snapshots, e) -> {
                    if (e != null) {
                        Log.w("MainActivity", "Listen failed.", e);
                        return;
                    }
                    StringBuilder logs = new StringBuilder();
                    for (DocumentSnapshot doc : snapshots) {
                        logs.append(doc.getString("action")).append("\n");
                    }
                    statusView.append("\nLogs:\n" + logs.toString());
                });

        FirebaseMessaging.getInstance().subscribeToTopic("device001");
    }
}