{"filter":false,"title":"edit.php","tooltip":"/admin_users/edit.php","undoManager":{"mark":1,"position":1,"stack":[[{"start":{"row":75,"column":24},"end":{"row":99,"column":30},"action":"remove","lines":["<div class=\"form-group\">","                            <input type=\"hidden\" class=\"form-control\" id=\"id\" name=\"id\" value=\"<?= $usuario->getId() ?>\">","                        </div>","                        <div class=\"form-group\">","                            <label for=\"nombre\">Nombre del usuario</label>","                            <input required type=\"text\" class=\"form-control\" id=\"nombre\" name=\"nombre\" placeholder=\"Introduce el nombre del usuario\" value=\"<?= $usuario->getNombre() ?>\">","                        </div>","                        <div class=\"form-group\">","                            <label for=\"correo\">Correo electrónico</label>","                            <input required type=\"email\" class=\"form-control\" id=\"correo\" name=\"correo\" placeholder=\"Introduce el correo del usuario\" value=\"<?= $usuario->getCorreo() ?>\">","                        </div>","                        <div class=\"form-group\">","                            <label for=\"alias\">Alias</label>","                            <input type=\"text\" class=\"form-control\" id=\"alias\" name=\"alias\" placeholder=\"Introduce el alias del usuario\" value=\"<?= $usuario->getAlias() ?>\">","                        </div>","                        <div class=\"form-group\">","                            <label for=\"clave\">Clave</label>","                            <input type=\"password\" class=\"form-control\" id=\"clave\" name=\"clave\" placeholder=\"Introduce la clave del usuario\">","                            ","                            <input type=\"checkbox\" id=\"desenmascarar\">","                        </div>","                        <div class=\"form-group\">","                            <label for=\"clave\">Usuario activo:</label>","                            <input type=\"checkbox\" class=\"form-control\" id=\"activo\" name=\"activo\" <?= Util::mySQLToCheckbox($usuario->getActivo()) ?>>","                        </div>"],"id":2},{"start":{"row":75,"column":24},"end":{"row":106,"column":30},"action":"insert","lines":["<div class=\"form-group\">","                            <input type=\"hidden\" class=\"form-control\" id=\"id\" name=\"id\" value=\"<?= $usuario->getId() ?>\">","                        </div>","                        <div class=\"form-group\">","                            <label for=\"nombre\">Nombre del usuario</label>","                            <input required type=\"text\" class=\"form-control\" id=\"nombre\" name=\"nombre\" placeholder=\"Introduce el nombre del usuario\" value=\"<?= $usuario->getNombre() ?>\">","                        </div>","                        <div class=\"form-group\">","                            <label for=\"correo\">Correo electrónico (login)</label>","                            <input required type=\"email\" class=\"form-control\" id=\"correo\" name=\"correo\" placeholder=\"Introduce el correo del usuario\" value=\"<?= $usuario->getCorreo() ?>\">","                        </div>","                        <div class=\"form-group\">","                            <label for=\"alias\">Alias</label>","                            <input type=\"text\" class=\"form-control\" id=\"alias\" name=\"alias\" placeholder=\"Introduce el alias del usuario\" value=\"<?= $usuario->getAlias() ?>\">","                        </div>","                    <hr>","                    <div class=\"form-group\">","                        <label for=\"clave\">Clave anterior</label>","                        <input type=\"password\" class=\"form-control\" id=\"claveAnterior\" name=\"claveAnterior\" placeholder=\"Introduce la clave anterior del usuario\">","                    </div>","                    <div class=\"form-group\">","                        <label for=\"clave\">Clave</label>","                        <input type=\"password\" class=\"form-control\" id=\"clave\" name=\"clave\" placeholder=\"Introduce la clave nueva del usuario\">","                    </div>","                    <div class=\"form-group\">","                        <label for=\"clave2\">Repite clave</label>","                        <input type=\"password\" class=\"form-control\" id=\"clave2\" name=\"clave2\" placeholder=\"Repite la clave nueva del usuario\">","                    </div>","                    <div class=\"form-group\">","                            <label for=\"clave\">Usuario activo (desactivará tu cuenta):</label>","                            <input type=\"checkbox\" class=\"form-control\" id=\"activo\" name=\"activo\" <?= Util::mySQLToCheckbox($usuario->getActivo()) ?>>","                        </div>"]}],[{"start":{"row":104,"column":61},"end":{"row":104,"column":85},"action":"remove","lines":[" (desactivará tu cuenta)"],"id":3}]]},"ace":{"folds":[],"scrolltop":1193.5,"scrollleft":94,"selection":{"start":{"row":104,"column":61},"end":{"row":104,"column":61},"isBackwards":false},"options":{"guessTabSize":true,"useWrapMode":false,"wrapToView":true},"firstLineState":{"row":76,"state":"start","mode":"ace/mode/php"}},"timestamp":1543863276737,"hash":"7872660de161927f11a1d1c398434a4d0b341688"}