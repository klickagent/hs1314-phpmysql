<?php
        $datas = array(
    array('id' => 5, 'parent' => 0, 'name' => 'rekursionen sind schon was tolles'),
    array('id' => 6, 'parent' => 5, 'name' => 'super sache'),
    array('id' => 7, 'parent' => 5, 'name' => 'sehr elegant'),
    array('id' => 8, 'parent' => 5, 'name' => 'aber auch rechenintensiv'),
    array('id' => 1, 'parent' => 0, 'name' => 'was haltet ihr von der vorlesung?'),
    array('id' => 2, 'parent' => 1, 'name' => 'naja..'),
    array('id' => 3, 'parent' => 1, 'name' => 'ist ja seine erste'),
    array('id' => 4, 'parent' => 1, 'name' => 'also ich finds super'),
  );
        
        function wtf($i,$t){
            global $datas;
            
            $s = '';
            foreach ($datas as $array) {
                if($array['parent']==$i){
                    $s .= '<li>'. $array['name'] . wtf($array['id'], $t) . '</li>'.PHP_EOL;
                }
            }
            if( !empty( $s ) ) $t .= '<ul>'.$s.'</ul>';
            
            return $t;
            
        }
        echo wtf(0,'');
        
        ?>