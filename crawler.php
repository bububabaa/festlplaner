<!DOCTYPE html>
<html lang="de">

    <body>
        <input type="text" class="form-control" value="Enter web page address">
        <input type="submit" value="Submit">
    </body>
</html>
        <?php
        function preg_substr($start, $end, $str) // Regular expression
        {

            $temp = preg_split($start, $str);
            $content = preg_split($end, $temp[1]);
            return $content[0];

        }
        function str_substr($start, $end, $str) // string split
        {

            $temp = explode($start, $str, 2);
            $content = explode($end, $temp[1], 2);
            return $content[0];

        }
        function writelog($str)
        {

            @unlink("log.txt");
            $open=fopen("log.txt","a" );
            fwrite($open,$str);
            fclose($open);

        }

        function getImage($url, $filename='', $dirName, $fileType, $type=0)
        {

            if($url == ''){return false;}

            //get the default file name
            $defaultFileName = basename($url);

            //file type
            $suffix = substr(strrchr($url,'.'), 1);

            if(!in_array($suffix, $fileType)){
                return false;
            }

            //set the file name
            $filename = $filename == '' ? time().rand(0,9).'.'.$suffix : $defaultFileName;

            //get remote file resource
            if($type){
                $ch = curl_init();
                $timeout = 5;
                curl_setopt($ch, CURLOPT_URL, $url);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
                curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
                $file = curl_exec($ch);
                curl_close($ch);
            }else{
                ob_start();
                readfile($url);
                $file = ob_get_contents();
                ob_end_clean();
            }

            //set file path
            $dirName = $dirName.'/'.date('Y', time()).'/'.date('m', time()).'/'.date('d',time()).'/';

            if(!file_exists($dirName)){
                mkdir($dirName, 0777, true);
            }

            //save file
            $res = fopen($dirName.$filename,'a');
            fwrite($res,$file);
            fclose($res);
            return $dirName.$filename;

        }

         if($_POST['URL']){
        //---------------------example-------------------
        $str = file_get_contents($_POST['URL']);
        $str = mb_convert_encoding($str, 'utf-8’,’iso-8859-1');
        writelog($str);

        //echo $str;
        echo('Title:' . Preg_substr('/<span id= "btAsinTitle"[^>}*>/','/<Vspan>/$str'));
        echo('<br/>');
        $imgurl=str_substr('var imageSrc = "','"',$str);
        echo '<img src="'.getImage($imgurl,'"','img' (array('jpg')));
    }
    ?>
