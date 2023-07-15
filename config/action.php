<?php
    require_once "db.config.php";

    $output = "";
    $errors = array();
    session_start();

    // Login action
    if(isset($_POST['login'])){

        // Get variable from our front-end
        $username = mysqli_real_escape_string($con, trim(htmlentities($_POST['username'])));
        $password = mysqli_real_escape_string($con, trim(htmlentities($_POST['password'])));

        // Validation
        if(empty($username)){array_push($errors, "Username is invalid");}
        if(empty($password)){array_push($errors, "Password is invalid");}

        // Second level of validation
        if(count($errors) == 0){
            // Crypt the password
            $password = md5($password);

            // Pass to database
            $request = "SELECT * users WHERE username = '$username' AND password = '$password'";
            $exe = mysqli_query($con, $request);

            // User validation
            if($exe !== false && $exe instanceof mysqli_result){
                $result = mysqli_num_rows($exe);
                
                $_SESSION = @mysqli_fetch_array($exe, MYSQLI_ASSOC);
                
                $email = $_SESSION['email'];
                $connected = mysqli_query($con, "UPDATE users SET `status` = 'Online' WHERE email = '$email'");

                if($connected){
                    $_SESSION['login'] = "Auth user";
                    header("Location: index.php");
                }else{
                    array_push($errors, "Network error... please try again...");
                }
            }else{
                array_push($errors, "Username or password are incorrect");
            }
            
        }
    }

    // Registration
  
    // Vérifier si le formulaire a été soumis
    if (isset($_POST['registration'])) {

        // Récupérer les données du formulaire soumis
        $username = mysqli_real_escape_string($con, trim(htmlentities($_POST['username'])));
        $email = mysqli_real_escape_string($con, trim(htmlentities($_POST['email'])));
        $password = mysqli_real_escape_string($con, trim(htmlentities($_POST['password'])));
        $gender = mysqli_real_escape_string($con, trim(htmlentities($_POST['gender'])));
        // Assurez-vous que le formulaire a un champ pour le genre.

        // Valider et nettoyer les données (vous pouvez implémenter votre propre validation ici)
        if(empty($username)){array_push($errors, "Username is invalid");}
        if(empty($email)){array_push($errors, "Email is invalid or incorrect");}
        if(empty($gender)){array_push($errors, "Sexe is incorrect");}
        if(empty($password)){array_push($errors, "Password is invalid");}
        
        if(count($errors) == 0){
            // Crypter le mot de passe (utilisez Bcrypt ou une méthode de hachage sécurisée)
        $hashedPassword = md5($password); // Notez que md5 est utilisé ici à des fins de démonstration, utilisez une méthode de hachage sécurisée dans un environnement réel.

        // Préparer la requête d'insertion
        $query = "INSERT INTO users (username, email, password, gender, status, created_at) VALUES (?, ?, ?, ?, 'active', NOW())";

        // Utiliser la connexion existante à la base de données
        $stmt = mysqli_prepare($con, $query);
        
        // Vérifier si la requête a été préparée avec succès
        if ($stmt) {
            // Lier les paramètres à la requête
            mysqli_stmt_bind_param($stmt, "ssss", $username, $email, $hashedPassword, $gender);

            // Exécuter la requête
            if (mysqli_stmt_execute($stmt)) {
                 
                $new_status = 'active'; 
                updateStatusAndRedirect($email, $new_status);
            } else {
                // Gérer l'erreur lors de l'insertion
                echo "<p class='alert alert-danger'>Erreur lors de l'enregistrement de l'utilisateur : </p>" . mysqli_error($con);
            }

            // Fermer la déclaration
            mysqli_stmt_close($stmt);
        } else {
            // Gérer l'erreur lors de la préparation de la requête
            echo "<p class='alert alert-danger'>Erreur lors de la préparation de la requête : </p>" . mysqli_error($con);
        }

        }
        // Fermer la connexion à la base de données
        mysqli_close($con);
    }

    // Fonction pour mettre à jour le statut de l'utilisateur et rediriger vers la page index avec une session d'authentification
    function updateStatusAndRedirect($user_email, $new_status) {
        global $con; // Récupérer la connexion à la base de données dans la fonction

        // Mettre à jour le statut de l'utilisateur dans la base de données
        $query = "UPDATE users SET `status` = ? WHERE email = ?";
        $stmt = mysqli_prepare($con, $query);
        
        if ($stmt) {
            mysqli_stmt_bind_param($stmt, "ss", $new_status, $user_email);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_close($stmt);
        } else {
            // Gérer l'erreur lors de la préparation de la requête
            echo "Erreur lors de la préparation de la requête : " . mysqli_error($con);
            exit;
        }

        // Démarrer la session pour l'authentification
        session_start();

        // Mettre à jour la session pour le nouveau statut de l'utilisateur
        $_SESSION['user_status'] = $new_status;

        // Rediriger vers la page index avec une session d'authentification
        header('Location: index.php');
        exit;
    } 