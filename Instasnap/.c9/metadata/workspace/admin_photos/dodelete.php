{"filter":false,"title":"dodelete.php","tooltip":"/admin_photos/dodelete.php","undoManager":{"mark":56,"position":56,"stack":[[{"start":{"row":19,"column":22},"end":{"row":19,"column":29},"action":"remove","lines":["roducto"],"id":2},{"start":{"row":19,"column":22},"end":{"row":19,"column":23},"action":"insert","lines":["h"]},{"start":{"row":19,"column":23},"end":{"row":19,"column":24},"action":"insert","lines":["o"]},{"start":{"row":19,"column":24},"end":{"row":19,"column":25},"action":"insert","lines":["t"]},{"start":{"row":19,"column":25},"end":{"row":19,"column":26},"action":"insert","lines":["o"]}],[{"start":{"row":24,"column":0},"end":{"row":51,"column":0},"action":"remove","lines":["if($id !== null) {","    if(!is_numeric($id) ||  $id <= 0) {","        header('Location: index.php');","        exit();","    }","    $resultado = $manager->remove($id);","} else {","    $db->getConnection()->beginTransaction();","    $error = false;","    foreach($ids as $id) {","        $resultadoParcial = $manager->remove($id);","        if($resultadoParcial === 0) {","            $error = true;","        } else {","            $resultado += $resultadoParcial;","        }","    }","    if($error) {","        $db->getConnection()->rollback();","    } else {","        $db->getConnection()->commit();","    }","}","","","","",""],"id":3},{"start":{"row":24,"column":0},"end":{"row":54,"column":1},"action":"insert","lines":["if($id !== null) {","    if(!is_numeric($id) ||  $id <= 0) {","        header('Location: index.php');","        exit();","    }","    $resultado = $manager->remove($id);","    Util::removeDirectory('../uploads/'.$id);","} else {","    /*","    $theConnection = $db->getConnection();","    $theConnection->beginTransaction();","    */","    $error = false;","    foreach($ids as $id) {","        $resultadoParcial = $manager->remove($id);","        if($resultadoParcial === 0) {","            $error = true;","        } else {","            $resultado += $resultadoParcial;","            Util::removeDirectory('../uploads/'.$id);","        }","    }","    ","    /*","    if($error) {","        $theConnection->rollback();","    } else {","        $theConnection->commit();","        ","    }*/","}"]}],[{"start":{"row":30,"column":16},"end":{"row":30,"column":25},"action":"remove","lines":["Directory"],"id":4},{"start":{"row":30,"column":16},"end":{"row":30,"column":17},"action":"insert","lines":["F"]},{"start":{"row":30,"column":17},"end":{"row":30,"column":18},"action":"insert","lines":["i"]},{"start":{"row":30,"column":18},"end":{"row":30,"column":19},"action":"insert","lines":["l"]},{"start":{"row":30,"column":19},"end":{"row":30,"column":20},"action":"insert","lines":["e"]}],[{"start":{"row":43,"column":24},"end":{"row":43,"column":33},"action":"remove","lines":["Directory"],"id":5},{"start":{"row":43,"column":24},"end":{"row":43,"column":25},"action":"insert","lines":["F"]},{"start":{"row":43,"column":25},"end":{"row":43,"column":26},"action":"insert","lines":["i"]},{"start":{"row":43,"column":26},"end":{"row":43,"column":27},"action":"insert","lines":["l"]},{"start":{"row":43,"column":27},"end":{"row":43,"column":28},"action":"insert","lines":["e"]}],[{"start":{"row":16,"column":0},"end":{"row":16,"column":34},"action":"remove","lines":["require '../classes/autoload.php';"],"id":6}],[{"start":{"row":1,"column":0},"end":{"row":2,"column":0},"action":"insert","lines":["",""],"id":7}],[{"start":{"row":2,"column":0},"end":{"row":2,"column":34},"action":"insert","lines":["require '../classes/autoload.php';"],"id":8}],[{"start":{"row":2,"column":34},"end":{"row":3,"column":0},"action":"insert","lines":["",""],"id":9}],[{"start":{"row":21,"column":32},"end":{"row":22,"column":0},"action":"insert","lines":["",""],"id":10},{"start":{"row":22,"column":0},"end":{"row":23,"column":0},"action":"insert","lines":["",""]},{"start":{"row":23,"column":0},"end":{"row":24,"column":0},"action":"insert","lines":["",""]},{"start":{"row":24,"column":0},"end":{"row":25,"column":0},"action":"insert","lines":["",""]}],[{"start":{"row":23,"column":0},"end":{"row":23,"column":1},"action":"insert","lines":["$"],"id":11},{"start":{"row":23,"column":1},"end":{"row":23,"column":2},"action":"insert","lines":["p"]},{"start":{"row":23,"column":2},"end":{"row":23,"column":3},"action":"insert","lines":["h"]},{"start":{"row":23,"column":3},"end":{"row":23,"column":4},"action":"insert","lines":["o"]},{"start":{"row":23,"column":4},"end":{"row":23,"column":5},"action":"insert","lines":["t"]},{"start":{"row":23,"column":5},"end":{"row":23,"column":6},"action":"insert","lines":["o"]}],[{"start":{"row":23,"column":6},"end":{"row":23,"column":7},"action":"insert","lines":[" "],"id":12},{"start":{"row":23,"column":7},"end":{"row":23,"column":8},"action":"insert","lines":["-"]},{"start":{"row":23,"column":8},"end":{"row":23,"column":9},"action":"insert","lines":[">"]}],[{"start":{"row":23,"column":8},"end":{"row":23,"column":9},"action":"remove","lines":[">"],"id":13},{"start":{"row":23,"column":7},"end":{"row":23,"column":8},"action":"remove","lines":["-"]}],[{"start":{"row":23,"column":7},"end":{"row":23,"column":8},"action":"insert","lines":["="],"id":14}],[{"start":{"row":23,"column":8},"end":{"row":23,"column":9},"action":"insert","lines":[" "],"id":15},{"start":{"row":23,"column":9},"end":{"row":23,"column":10},"action":"insert","lines":["$"]},{"start":{"row":23,"column":10},"end":{"row":23,"column":11},"action":"insert","lines":["m"]},{"start":{"row":23,"column":11},"end":{"row":23,"column":12},"action":"insert","lines":["a"]},{"start":{"row":23,"column":12},"end":{"row":23,"column":13},"action":"insert","lines":["n"]},{"start":{"row":23,"column":13},"end":{"row":23,"column":14},"action":"insert","lines":["a"]},{"start":{"row":23,"column":14},"end":{"row":23,"column":15},"action":"insert","lines":["g"]},{"start":{"row":23,"column":15},"end":{"row":23,"column":16},"action":"insert","lines":["e"]},{"start":{"row":23,"column":16},"end":{"row":23,"column":17},"action":"insert","lines":["r"]}],[{"start":{"row":23,"column":17},"end":{"row":23,"column":18},"action":"insert","lines":[" "],"id":16},{"start":{"row":23,"column":18},"end":{"row":23,"column":19},"action":"insert","lines":["-"]},{"start":{"row":23,"column":19},"end":{"row":23,"column":20},"action":"insert","lines":[">"]}],[{"start":{"row":23,"column":20},"end":{"row":23,"column":21},"action":"insert","lines":[" "],"id":17},{"start":{"row":23,"column":21},"end":{"row":23,"column":22},"action":"insert","lines":["g"]},{"start":{"row":23,"column":22},"end":{"row":23,"column":23},"action":"insert","lines":["e"]},{"start":{"row":23,"column":23},"end":{"row":23,"column":24},"action":"insert","lines":["t"]}],[{"start":{"row":23,"column":24},"end":{"row":23,"column":26},"action":"insert","lines":["()"],"id":18}],[{"start":{"row":23,"column":26},"end":{"row":23,"column":27},"action":"insert","lines":[";"],"id":19}],[{"start":{"row":23,"column":25},"end":{"row":23,"column":26},"action":"insert","lines":["$"],"id":20},{"start":{"row":23,"column":26},"end":{"row":23,"column":27},"action":"insert","lines":["i"]},{"start":{"row":23,"column":27},"end":{"row":23,"column":28},"action":"insert","lines":["d"]}],[{"start":{"row":21,"column":32},"end":{"row":22,"column":0},"action":"insert","lines":["",""],"id":21},{"start":{"row":22,"column":0},"end":{"row":23,"column":0},"action":"insert","lines":["",""]}],[{"start":{"row":36,"column":5},"end":{"row":37,"column":0},"action":"insert","lines":["",""],"id":22},{"start":{"row":37,"column":0},"end":{"row":37,"column":4},"action":"insert","lines":["    "]},{"start":{"row":37,"column":4},"end":{"row":38,"column":0},"action":"insert","lines":["",""]},{"start":{"row":38,"column":0},"end":{"row":38,"column":4},"action":"insert","lines":["    "]},{"start":{"row":38,"column":4},"end":{"row":39,"column":0},"action":"insert","lines":["",""]},{"start":{"row":39,"column":0},"end":{"row":39,"column":4},"action":"insert","lines":["    "]},{"start":{"row":39,"column":4},"end":{"row":40,"column":0},"action":"insert","lines":["",""]},{"start":{"row":40,"column":0},"end":{"row":40,"column":4},"action":"insert","lines":["    "]}],[{"start":{"row":25,"column":0},"end":{"row":25,"column":30},"action":"remove","lines":["$photo = $manager -> get($id);"],"id":23}],[{"start":{"row":38,"column":4},"end":{"row":38,"column":34},"action":"insert","lines":["$photo = $manager -> get($id);"],"id":24}],[{"start":{"row":38,"column":34},"end":{"row":39,"column":0},"action":"insert","lines":["",""],"id":25},{"start":{"row":39,"column":0},"end":{"row":39,"column":4},"action":"insert","lines":["    "]}],[{"start":{"row":42,"column":39},"end":{"row":43,"column":0},"action":"insert","lines":["",""],"id":26},{"start":{"row":43,"column":0},"end":{"row":43,"column":4},"action":"insert","lines":["    "]},{"start":{"row":43,"column":4},"end":{"row":44,"column":0},"action":"insert","lines":["",""]},{"start":{"row":44,"column":0},"end":{"row":44,"column":4},"action":"insert","lines":["    "]}],[{"start":{"row":39,"column":4},"end":{"row":39,"column":5},"action":"insert","lines":["$"],"id":27},{"start":{"row":39,"column":5},"end":{"row":39,"column":6},"action":"insert","lines":["u"]},{"start":{"row":39,"column":6},"end":{"row":39,"column":7},"action":"insert","lines":["i"]},{"start":{"row":39,"column":7},"end":{"row":39,"column":8},"action":"insert","lines":["d"]}],[{"start":{"row":39,"column":8},"end":{"row":39,"column":9},"action":"insert","lines":[" "],"id":28},{"start":{"row":39,"column":9},"end":{"row":39,"column":10},"action":"insert","lines":["="]}],[{"start":{"row":39,"column":10},"end":{"row":39,"column":11},"action":"insert","lines":[" "],"id":29},{"start":{"row":39,"column":11},"end":{"row":39,"column":12},"action":"insert","lines":["$"]},{"start":{"row":39,"column":12},"end":{"row":39,"column":13},"action":"insert","lines":["p"]},{"start":{"row":39,"column":13},"end":{"row":39,"column":14},"action":"insert","lines":["h"]},{"start":{"row":39,"column":14},"end":{"row":39,"column":15},"action":"insert","lines":["o"]}],[{"start":{"row":39,"column":15},"end":{"row":39,"column":16},"action":"insert","lines":["t"],"id":30},{"start":{"row":39,"column":16},"end":{"row":39,"column":17},"action":"insert","lines":["o"]}],[{"start":{"row":39,"column":17},"end":{"row":39,"column":18},"action":"insert","lines":[" "],"id":31},{"start":{"row":39,"column":18},"end":{"row":39,"column":19},"action":"insert","lines":["-"]},{"start":{"row":39,"column":19},"end":{"row":39,"column":20},"action":"insert","lines":[">"]}],[{"start":{"row":39,"column":20},"end":{"row":39,"column":21},"action":"insert","lines":[" "],"id":32},{"start":{"row":39,"column":21},"end":{"row":39,"column":22},"action":"insert","lines":["g"]},{"start":{"row":39,"column":22},"end":{"row":39,"column":23},"action":"insert","lines":["e"]},{"start":{"row":39,"column":23},"end":{"row":39,"column":24},"action":"insert","lines":["t"]},{"start":{"row":39,"column":24},"end":{"row":39,"column":25},"action":"insert","lines":["U"]},{"start":{"row":39,"column":25},"end":{"row":39,"column":26},"action":"insert","lines":["s"]}],[{"start":{"row":39,"column":21},"end":{"row":39,"column":26},"action":"remove","lines":["getUs"],"id":33},{"start":{"row":39,"column":21},"end":{"row":39,"column":30},"action":"insert","lines":["getUserId"]}],[{"start":{"row":39,"column":30},"end":{"row":39,"column":32},"action":"insert","lines":["()"],"id":34}],[{"start":{"row":39,"column":32},"end":{"row":39,"column":33},"action":"insert","lines":[";"],"id":35}],[{"start":{"row":40,"column":4},"end":{"row":40,"column":5},"action":"insert","lines":["$"],"id":36},{"start":{"row":40,"column":5},"end":{"row":40,"column":6},"action":"insert","lines":["f"]},{"start":{"row":40,"column":6},"end":{"row":40,"column":7},"action":"insert","lines":["i"]},{"start":{"row":40,"column":7},"end":{"row":40,"column":8},"action":"insert","lines":["l"]},{"start":{"row":40,"column":8},"end":{"row":40,"column":9},"action":"insert","lines":["e"]},{"start":{"row":40,"column":9},"end":{"row":40,"column":10},"action":"insert","lines":["n"]},{"start":{"row":40,"column":10},"end":{"row":40,"column":11},"action":"insert","lines":["a"]},{"start":{"row":40,"column":11},"end":{"row":40,"column":12},"action":"insert","lines":["m"]},{"start":{"row":40,"column":12},"end":{"row":40,"column":13},"action":"insert","lines":["e"]}],[{"start":{"row":40,"column":13},"end":{"row":40,"column":14},"action":"insert","lines":[" "],"id":37},{"start":{"row":40,"column":14},"end":{"row":40,"column":15},"action":"insert","lines":["="]}],[{"start":{"row":40,"column":15},"end":{"row":40,"column":16},"action":"insert","lines":[" "],"id":38},{"start":{"row":40,"column":16},"end":{"row":40,"column":17},"action":"insert","lines":["$"]},{"start":{"row":40,"column":17},"end":{"row":40,"column":18},"action":"insert","lines":["p"]},{"start":{"row":40,"column":18},"end":{"row":40,"column":19},"action":"insert","lines":["h"]},{"start":{"row":40,"column":19},"end":{"row":40,"column":20},"action":"insert","lines":["o"]},{"start":{"row":40,"column":20},"end":{"row":40,"column":21},"action":"insert","lines":["t"]},{"start":{"row":40,"column":21},"end":{"row":40,"column":22},"action":"insert","lines":["o"]}],[{"start":{"row":40,"column":22},"end":{"row":40,"column":23},"action":"insert","lines":[" "],"id":39},{"start":{"row":40,"column":23},"end":{"row":40,"column":24},"action":"insert","lines":["-"]},{"start":{"row":40,"column":24},"end":{"row":40,"column":25},"action":"insert","lines":[">"]},{"start":{"row":40,"column":25},"end":{"row":40,"column":26},"action":"insert","lines":["g"]},{"start":{"row":40,"column":26},"end":{"row":40,"column":27},"action":"insert","lines":["e"]},{"start":{"row":40,"column":27},"end":{"row":40,"column":28},"action":"insert","lines":["t"]}],[{"start":{"row":40,"column":28},"end":{"row":40,"column":29},"action":"insert","lines":["F"],"id":40},{"start":{"row":40,"column":29},"end":{"row":40,"column":30},"action":"insert","lines":["i"]},{"start":{"row":40,"column":30},"end":{"row":40,"column":31},"action":"insert","lines":["l"]}],[{"start":{"row":40,"column":30},"end":{"row":40,"column":31},"action":"remove","lines":["l"],"id":41},{"start":{"row":40,"column":29},"end":{"row":40,"column":30},"action":"remove","lines":["i"]},{"start":{"row":40,"column":28},"end":{"row":40,"column":29},"action":"remove","lines":["F"]}],[{"start":{"row":40,"column":28},"end":{"row":40,"column":29},"action":"insert","lines":["S"],"id":42},{"start":{"row":40,"column":29},"end":{"row":40,"column":30},"action":"insert","lines":["t"]},{"start":{"row":40,"column":30},"end":{"row":40,"column":31},"action":"insert","lines":["o"]}],[{"start":{"row":40,"column":31},"end":{"row":40,"column":32},"action":"insert","lines":["_"],"id":43},{"start":{"row":40,"column":32},"end":{"row":40,"column":33},"action":"insert","lines":["F"]},{"start":{"row":40,"column":33},"end":{"row":40,"column":34},"action":"insert","lines":["i"]},{"start":{"row":40,"column":34},"end":{"row":40,"column":35},"action":"insert","lines":["l"]},{"start":{"row":40,"column":35},"end":{"row":40,"column":36},"action":"insert","lines":["e"]},{"start":{"row":40,"column":36},"end":{"row":40,"column":37},"action":"insert","lines":["n"]},{"start":{"row":40,"column":37},"end":{"row":40,"column":38},"action":"insert","lines":["a"]},{"start":{"row":40,"column":38},"end":{"row":40,"column":39},"action":"insert","lines":["m"]},{"start":{"row":40,"column":39},"end":{"row":40,"column":40},"action":"insert","lines":["e"]}],[{"start":{"row":40,"column":40},"end":{"row":40,"column":42},"action":"insert","lines":["()"],"id":44}],[{"start":{"row":40,"column":42},"end":{"row":40,"column":43},"action":"insert","lines":[";"],"id":45}],[{"start":{"row":45,"column":36},"end":{"row":45,"column":37},"action":"insert","lines":["u"],"id":46}],[{"start":{"row":45,"column":39},"end":{"row":45,"column":40},"action":"insert","lines":["."],"id":47}],[{"start":{"row":45,"column":40},"end":{"row":45,"column":42},"action":"insert","lines":["''"],"id":48}],[{"start":{"row":45,"column":41},"end":{"row":45,"column":42},"action":"insert","lines":["/"],"id":49}],[{"start":{"row":45,"column":43},"end":{"row":45,"column":44},"action":"insert","lines":["."],"id":50}],[{"start":{"row":45,"column":44},"end":{"row":45,"column":45},"action":"insert","lines":["$"],"id":51},{"start":{"row":45,"column":45},"end":{"row":45,"column":46},"action":"insert","lines":["f"]},{"start":{"row":45,"column":46},"end":{"row":45,"column":47},"action":"insert","lines":["i"]},{"start":{"row":45,"column":47},"end":{"row":45,"column":48},"action":"insert","lines":["l"]},{"start":{"row":45,"column":48},"end":{"row":45,"column":49},"action":"insert","lines":["e"]},{"start":{"row":45,"column":49},"end":{"row":45,"column":50},"action":"insert","lines":["n"]},{"start":{"row":45,"column":50},"end":{"row":45,"column":51},"action":"insert","lines":["a"]},{"start":{"row":45,"column":51},"end":{"row":45,"column":52},"action":"insert","lines":["m"]},{"start":{"row":45,"column":52},"end":{"row":45,"column":53},"action":"insert","lines":["e"]}],[{"start":{"row":44,"column":0},"end":{"row":44,"column":4},"action":"remove","lines":["    "],"id":52},{"start":{"row":43,"column":4},"end":{"row":44,"column":0},"action":"remove","lines":["",""]},{"start":{"row":43,"column":0},"end":{"row":43,"column":4},"action":"remove","lines":["    "]},{"start":{"row":42,"column":39},"end":{"row":43,"column":0},"action":"remove","lines":["",""]}],[{"start":{"row":51,"column":50},"end":{"row":52,"column":0},"action":"insert","lines":["",""],"id":53},{"start":{"row":52,"column":0},"end":{"row":52,"column":8},"action":"insert","lines":["        "]},{"start":{"row":52,"column":8},"end":{"row":53,"column":0},"action":"insert","lines":["",""]},{"start":{"row":53,"column":0},"end":{"row":53,"column":8},"action":"insert","lines":["        "]}],[{"start":{"row":50,"column":26},"end":{"row":51,"column":0},"action":"insert","lines":["",""],"id":54},{"start":{"row":51,"column":0},"end":{"row":51,"column":8},"action":"insert","lines":["        "]},{"start":{"row":51,"column":8},"end":{"row":52,"column":0},"action":"insert","lines":["",""]},{"start":{"row":52,"column":0},"end":{"row":52,"column":8},"action":"insert","lines":["        "]},{"start":{"row":52,"column":8},"end":{"row":53,"column":0},"action":"insert","lines":["",""]},{"start":{"row":53,"column":0},"end":{"row":53,"column":8},"action":"insert","lines":["        "]},{"start":{"row":53,"column":8},"end":{"row":54,"column":0},"action":"insert","lines":["",""]},{"start":{"row":54,"column":0},"end":{"row":54,"column":8},"action":"insert","lines":["        "]}],[{"start":{"row":52,"column":8},"end":{"row":54,"column":43},"action":"insert","lines":["$photo = $manager -> get($id);","    $uid = $photo -> getUserId();","    $filename = $photo ->getSto_Filename();"],"id":55}],[{"start":{"row":53,"column":4},"end":{"row":53,"column":8},"action":"insert","lines":["    "],"id":56}],[{"start":{"row":54,"column":4},"end":{"row":54,"column":8},"action":"insert","lines":["    "],"id":57}],[{"start":{"row":64,"column":12},"end":{"row":64,"column":48},"action":"remove","lines":["Util::removeFile('../uploads/'.$id);"],"id":58},{"start":{"row":64,"column":12},"end":{"row":64,"column":63},"action":"insert","lines":["Util::removeFile('../uploads/'.$uid.'/'.$filename);"]}]]},"ace":{"folds":[],"scrolltop":660,"scrollleft":0,"selection":{"start":{"row":64,"column":63},"end":{"row":64,"column":63},"isBackwards":false},"options":{"guessTabSize":true,"useWrapMode":false,"wrapToView":true},"firstLineState":{"row":37,"state":"php-start","mode":"ace/mode/php"}},"timestamp":1543854052587,"hash":"b3232a2d13cd44a39b3c24daf67186766a0f07c5"}