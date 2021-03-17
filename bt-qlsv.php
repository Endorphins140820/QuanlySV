<?php
$view = "CHỌN 1: Để nhập danh sách sinh viên." . "\n"."CHỌN 2: Để hiển thị danh sách sinh viên." . "\n"
."CHỌN 3: Để tìm kiếm sinh viên theo tên." . "\n"."CHỌN 4 : Để sửa" . "\n"."CHỌN 5: Thoát" . "\n";
echo $view;
function khaibao()
{
    $file = file_get_contents('document.json');
    $data = json_decode($file, true);
    do {
        $name = (string)readline("Nhập tên cho sinh viên : ");
    } while ($name == null || $name<1);
    echo "\n";
    do {
        $age = (int)readline("Nhâp tuổi cho sinh viên : ");
    } while ($age <= 0 && $age == null);
    echo "\n";
    do {
        $class = (string)readline("Nhập lớp cho sinh viên : ");
    } while ($class == null);
    echo "\n";
    $data[] = [
        "Name" => $name,
        "Age" => $age,
        "Class" => $class
    ];
    $myfile = fopen('document.json', 'w');// mở file
    fwrite($myfile, json_encode($data));
    fclose($myfile);
    chon();
}

function danhsach()
{
    $content = file_get_contents('document.json');
    $c1 = (json_decode($content, true));
    echo "số học sinh viên hiện nay : ";
    echo sizeof($c1) . "\n";
    $num = sizeof($c1);
    $cd = (array)$c1;
    for ($i = 0; $i < $num; $i++) {
        echo "Sinh viên thứ ", $i + 1 . "\n";
        print_r($cd[$i]);
    }
    chon();
}

function timkiem()
{
    $name = (string)readline("Nhập tên cho sinh viên : ");
    $content = file_get_contents('document.json');
    $objitems = json_decode($content, true);
    foreach ($objitems as $key => $student) {
        if ($name == $student['Name']) {
            echo 'Kết quả là  : ';
            print_r($student);
        }
    }
    chon();
}

function update()
{
    $jsonString = file_get_contents('document.json');
    $data = json_decode($jsonString, true);
    retry:
    $name1=(string)readline("Nhâp tên người cần thay đổi :");
    foreach ($data as $student) {
        if ($name1 == $student['Name']) {
            echo "Thông tin sinh viên  "."\n";
            print_r($student);
        } else {
            echo "*-----Không tìm thấy sinh viên có tên :" , $name1."-----*"."\n";
                goto retry;
        }
    }
    foreach ($data as $key => $entry) {
        if ($entry['Name'] == $name1) {
            $data[$key]['Name'] = (string)readline("Nhâp tên mới :");
            $data[$key]['Age'] = (int)readline("Nhâp tuổi mới :");
            $data[$key]['Class'] = (string)readline("Nhâp lớp mới :");
        }
    }
    $newJsonString = json_encode($data);
    file_put_contents('document.json', $newJsonString);
    chon();
}

function chon()
{
    $chon = (int)readline('Mời bạn chọn :') . "<br />";
    switch ($chon) {
        case 1:
            khaibao();
            break;
        case 2:
            danhsach();
            break;
        case 3:
            timkiem();
            break;
        case 4:
            update();
            break;
        case 5:
            echo "Đã đóng chương trình " . "\n";
            die();
        default :
            echo "Sai cú pháp , Mời thử lại" . "\n";
            chon();
    }
}

chon();