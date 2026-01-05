<?php

// --- Fixed DB credentials ---
// For production, this is to be change on CPanel
$db_host = "localhost";
$db_user = "root";
$db_pass = "";
$db_name = "e_commerce_demo_db";
$db_port = 3306;

// UUID generator (manual)
function generate_uuid_v4_manual() {
    $randomHex = function($length) {
        $hex = '';
        for ($i = 0; $i < $length; $i++) {
            $hex .= dechex(mt_rand(0, 15));
        }
        return $hex;
    };

    $time_low = $randomHex(8);
    $time_mid = $randomHex(4);
    $time_hi_and_version = '4' . $randomHex(3);
    $variants = ['8', '9', 'a', 'b'];
    $clock_seq_hi_and_reserved = $variants[mt_rand(0,3)] . $randomHex(3);
    $node = $randomHex(12);

    return sprintf(
        '%s-%s-%s-%s-%s',
        $time_low,
        $time_mid,
        $time_hi_and_version,
        $clock_seq_hi_and_reserved,
        $node
    );
}

function transactionalMySQLQuery(string $query, array $params = []) {
    global $db_host, $db_user, $db_pass, $db_name, $db_port;

    // Open connection
    $mysqli = new mysqli($db_host, $db_user, $db_pass, $db_name, $db_port);
    if ($mysqli->connect_errno) {
        return "Connection failed: " . $mysqli->connect_error;
    }

    $resultData = null;

    // Detect multi-query
    $multi = strpos($query, ";") !== false;

    try {
        $mysqli->begin_transaction();

        if ($multi) {
            if (!$mysqli->multi_query($query)) {
                throw new Exception($mysqli->error);
            }

            // collect results for each query
            $allResults = [];
            do {
                if ($res = $mysqli->store_result()) {
                    $allResults[] = $res->fetch_all(MYSQLI_ASSOC);
                    $res->free();
                }
            } while ($mysqli->more_results() && $mysqli->next_result());

            $mysqli->commit();
            return true; // multi query success → return true
        } else {
            if ($params) {
                $stmt = $mysqli->prepare($query);
                if (!$stmt) throw new Exception("Prepare failed: " . $mysqli->error);

                // Build types for bind_param
                $types = "";
                foreach ($params as $p) {
                    if (is_int($p)) $types .= "i";
                    elseif (is_double($p)) $types .= "d";
                    else $types .= "s";
                }

                $stmt->bind_param($types, ...$params);

                if (!$stmt->execute()) {
                    throw new Exception("Execution failed: " . $stmt->error);
                }

                if (stripos(trim($query), "SELECT") === 0) {
                    $res = $stmt->get_result();
                    $resultData = $res->fetch_all(MYSQLI_ASSOC);
                    $stmt->close();
                    $mysqli->commit();
                    $mysqli->close();
                    return $resultData;
                } else {
                    $stmt->close();
                    $mysqli->commit();
                    $mysqli->close();
                    return true; // non-SELECT → success
                }
            } else {
                $res = $mysqli->query($query);
                if ($res === false) throw new Exception($mysqli->error);

                if ($res === true) {
                    $mysqli->commit();
                    $mysqli->close();
                    return true;
                } else { // SELECT query
                    $resultData = $res->fetch_all(MYSQLI_ASSOC);
                    $res->free();
                    $mysqli->commit();
                    $mysqli->close();
                    return $resultData;
                }
            }
        }
    } catch (Exception $e) {
        $mysqli->rollback();
        $mysqli->close();
        return "Query error: " . $e->getMessage();
    }
}

// ------------------------------------------------------------------------------------------------------

// // Example Usages:

// // SELECT
// $result = transactionalMySQLQuery("SELECT * FROM users WHERE username = ?", ["johndoe"]);
// if (is_string($result)) {
//     echo "Error: $result";
// } else {
//     print_r($result);
// }

// // INSERT
// $result = transactionalMySQLQuery(
//     "INSERT INTO users (first_name, last_name, username, password) VALUES (?, ?, ?, ?)",
//     ["John", "Doe", "johndoe", password_hash("password123", PASSWORD_DEFAULT)]
// );

// if ($result === true) {
//     echo "Insert successful!";
// } else {
//     echo "Error: $result";
// }

// // Multi-query
// $result = transactionalMySQLQuery("
//     INSERT INTO users (first_name, last_name) VALUES ('Alice','Smith');
//     INSERT INTO users (first_name, last_name) VALUES ('Bob','Jones');
// ");

// if ($result === true) {
//     echo "Multi-query executed!";
// } else {
//     echo "Error: $result";
// }
