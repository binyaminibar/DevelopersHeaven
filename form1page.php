<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get the form data
    $main_branch = $_POST['main-branch'];
    $coding_activities = $_POST['coding-activities'];
    $education_level = $_POST['education-level'];
    $years_coding = $_POST['years-coding'];
    $professional_years_coding = $_POST['professional-years-coding'];
    $gdp = $_POST['GDP'];
    $languages_worked_with = $_POST['languages-worked-with'];
    $worked_with_sql = $_POST['worked-with-sql'];
    $age = $_POST['age'];
    $gender = $_POST['gender'];
    $salary = $_POST['salary'];

    // Create a Pandas DataFrame from the form data
    $data = array(
        'MainBranch' => array($main_branch),
        'CodingActivities' => array($coding_activities),
        'EdLevel' => array($education_level),
        'YearsCode' => array($years_coding),
        'YearsCodePro' => array($professional_years_coding),
        'GDP' => array($gdp),
        'Python' => array(in_array('Python', $languages_worked_with) ? 1 : 0),
        'JavaScript' => array(in_array('JavaScript', $languages_worked_with) ? 1 : 0),
        'SQL' => array($worked_with_sql == 'yes' ? 1 : 0),
        'HTML' => array(in_array('HTML', $languages_worked_with) ? 1 : 0),
        'PHP' => array(in_array('PHP', $languages_worked_with) ? 1 : 0),
        'Java' => array(in_array('Java', $languages_worked_with) ? 1 : 0),
        'C++' => array(in_array('C++', $languages_worked_with) ? 1 : 0),
        'C' => array(in_array('C', $languages_worked_with) ? 1 : 0),
        'Age' => array($age),
        'Gender' => array($gender),
        'ConvertedCompYearly' => array($salary)
    );
    $df = pd.DataFrame($data);

    // Call the Python script to predict the DevType
    $output = shell_exec('C:\Users\barus\Downloads\to brody prediction 1.py');
    $result = explode(':', $output)[1];
    $devtype = trim($result);

    // Return the predicted DevType to the user
    echo "<h1>Predicted DevType: $devtype</h1>";
}
?>
