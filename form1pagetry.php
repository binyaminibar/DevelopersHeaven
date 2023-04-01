<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get the form data
    $main_branch = $_POST['main-branch'];
    $coding_activities = $_POST['coding-activities'];
    $education_level = $_POST['education-level'];
    $years_coding = $_POST['years-coding'];
    $professional_years_coding = $_POST['professional-years-coding'];
    $gdp = $_POST['GDP'];
    $python = isset($_POST['python']) ? $_POST['python'] : '';
    $javascript = isset($_POST['javascript']) ? $_POST['javascript'] : '';
    $html = isset($_POST['html']) ? $_POST['html'] : '';
    $php = isset($_POST['php']) ? $_POST['php'] : '';
    $java = isset($_POST['java']) ? $_POST['java'] : '';
    $cpp = isset($_POST['c++']) ? $_POST['c++'] : '';
    $worked_with_sql = $_POST['worked-with-sql'];
    $age = $_POST['age'];
    $gender = $_POST['gender'];
    $salary = $_POST['salary'];

    // Convert the form data to a JSON string
    $data = array(
        'main_branch' => $main_branch,
        'coding_activities' => $coding_activities,
        'education_level' => $education_level,
        'years_coding' => $years_coding,
        'professional_years_coding' => $professional_years_coding,
        'gdp' => $gdp,
        'languages_worked_with' => array(
            'Python' => $python == 'yes' ? 1 : 0,
            'JavaScript' => $javascript == 'yes' ? 1 : 0,
            'HTML' => $html == 'yes' ? 1 : 0,
            'PHP' => $php == 'yes' ? 1 : 0,
            'Java' => $java == 'yes' ? 1 : 0,
            'C++' => $cpp == 'yes' ? 1 : 0
        ),
        'worked_with_sql' => $worked_with_sql,
        'age' => $age,
        'gender' => $gender,
        'salary' => $salary
    );

    $json_data = json_encode($data);

    // Call the Python script to predict the DevType
    $command = "python3 /path/to/your/python/script.py '" . $json_data . "'";
    $output = shell_exec($command);
    $result = json_decode($output, true);
    $devtype = $result['predicted_devtype'];

    // Return the predicted DevType to the user
    echo "<h1>Predicted DevType: $devtype</h1>";
}
?>
