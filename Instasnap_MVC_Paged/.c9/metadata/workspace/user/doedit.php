{"filter":false,"title":"doedit.php","tooltip":"/user/doedit.php","undoManager":{"mark":10,"position":10,"stack":[[{"start":{"row":32,"column":0},"end":{"row":33,"column":21},"action":"remove","lines":["","var_export($usuario);"],"id":2}],[{"start":{"row":34,"column":0},"end":{"row":35,"column":0},"action":"remove","lines":["",""],"id":3},{"start":{"row":33,"column":0},"end":{"row":34,"column":0},"action":"remove","lines":["",""]}],[{"start":{"row":41,"column":0},"end":{"row":41,"column":4},"action":"remove","lines":["    "],"id":4},{"start":{"row":40,"column":8},"end":{"row":41,"column":0},"action":"remove","lines":["",""]}],[{"start":{"row":13,"column":0},"end":{"row":20,"column":0},"action":"remove","lines":["$sesion = new Session(App::SESSION_NAME);","$adminuser = $sesion->getLogin()->getAdministrador();","","if(!$sesion->isLogged()) {","    header('Location: ..');","    exit();","}",""],"id":5},{"start":{"row":13,"column":0},"end":{"row":20,"column":1},"action":"insert","lines":["$sesion = new Session(App::SESSION_NAME);","","$userLogin = null;","$loggedUser = $sesion -> isLogged();","$adminUser = $sesion -> isAdmin();","if($loggedUser) {","    $userLogin = $sesion->getLogin();","}"]}],[{"start":{"row":22,"column":0},"end":{"row":25,"column":1},"action":"insert","lines":["if ($linkToken==null && !$loggedUser) {","  header('Location: ..');","  exit();","}"],"id":6}],[{"start":{"row":22,"column":4},"end":{"row":22,"column":24},"action":"remove","lines":["$linkToken==null && "],"id":7}],[{"start":{"row":21,"column":0},"end":{"row":22,"column":0},"action":"insert","lines":["",""],"id":8},{"start":{"row":22,"column":0},"end":{"row":22,"column":1},"action":"insert","lines":["/"]},{"start":{"row":22,"column":1},"end":{"row":22,"column":2},"action":"insert","lines":["/"]},{"start":{"row":22,"column":2},"end":{"row":22,"column":3},"action":"insert","lines":["N"]}],[{"start":{"row":22,"column":3},"end":{"row":22,"column":4},"action":"insert","lines":["o"],"id":9}],[{"start":{"row":22,"column":4},"end":{"row":22,"column":5},"action":"insert","lines":[" "],"id":10},{"start":{"row":22,"column":5},"end":{"row":22,"column":6},"action":"insert","lines":["l"]},{"start":{"row":22,"column":6},"end":{"row":22,"column":7},"action":"insert","lines":["o"]},{"start":{"row":22,"column":7},"end":{"row":22,"column":8},"action":"insert","lines":["g"]},{"start":{"row":22,"column":8},"end":{"row":22,"column":9},"action":"insert","lines":["i"]},{"start":{"row":22,"column":9},"end":{"row":22,"column":10},"action":"insert","lines":["n"]}],[{"start":{"row":22,"column":10},"end":{"row":22,"column":11},"action":"insert","lines":[" "],"id":11},{"start":{"row":22,"column":11},"end":{"row":22,"column":12},"action":"insert","lines":["-"]},{"start":{"row":22,"column":12},"end":{"row":22,"column":13},"action":"insert","lines":[">"]}],[{"start":{"row":22,"column":13},"end":{"row":22,"column":14},"action":"insert","lines":[" "],"id":12},{"start":{"row":22,"column":14},"end":{"row":22,"column":15},"action":"insert","lines":["g"]},{"start":{"row":22,"column":15},"end":{"row":22,"column":16},"action":"insert","lines":["t"]},{"start":{"row":22,"column":16},"end":{"row":22,"column":17},"action":"insert","lines":["f"]},{"start":{"row":22,"column":17},"end":{"row":22,"column":18},"action":"insert","lines":["o"]}]]},"ace":{"folds":[],"scrolltop":0,"scrollleft":0,"selection":{"start":{"row":12,"column":0},"end":{"row":26,"column":1},"isBackwards":true},"options":{"guessTabSize":true,"useWrapMode":false,"wrapToView":true},"firstLineState":0},"timestamp":1544028629515,"hash":"c687d06c740b890bb410714ef5fdf57d79db6584"}