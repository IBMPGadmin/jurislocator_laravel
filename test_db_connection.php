<?php

// Test database connection and client data
$host = '127.0.0.1';
$dbname = 'j2';
$username = 'root';
$password = '';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    echo "Database connection successful!\n\n";
    
    // Check client_table
    $stmt = $pdo->query("SELECT COUNT(*) FROM client_table");
    $count = $stmt->fetchColumn();
    echo "Total clients in client_table: $count\n";
    
    if ($count > 0) {
        $stmt = $pdo->query("SELECT id, client_name, client_email, user_id FROM client_table LIMIT 5");
        $clients = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        echo "\nClient data:\n";
        foreach ($clients as $client) {
            echo "- ID: {$client['id']}, Name: {$client['client_name']}, User: {$client['user_id']}\n";
        }
    }
    
    // Check users table
    $stmt = $pdo->query("SELECT COUNT(*) FROM users");
    $userCount = $stmt->fetchColumn();
    echo "\nTotal users: $userCount\n";
    
    if ($userCount > 0) {
        $stmt = $pdo->query("SELECT id, name, email FROM users LIMIT 3");
        $users = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        echo "\nUser data:\n";
        foreach ($users as $user) {
            echo "- ID: {$user['id']}, Name: {$user['name']}, Email: {$user['email']}\n";
        }
    }
    
} catch (PDOException $e) {
    echo "Database error: " . $e->getMessage() . "\n";
}
