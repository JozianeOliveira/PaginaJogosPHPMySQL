<?php 
        function thumb ($arq) {
            $caminho = "fotos/$arq";
            if (is_null ($arq) || !file_exists($caminho)) {
                return "fotos/indisponivel.png";
            } else {
                return $caminho;
            }
        }

        function voltar() {
            return "<a href='index.php'><span class='material-symbols-outlined'>arrow_back</span></a> ";
        }

        function msg_sucesso($m) {
            $resp = "<div class='sucesso'><span class='material-symbols-outlined'>task_alt</span> $m</div>";
            return $resp;
        }

        function msg_aviso($m) {
            $resp = "<div class='aviso'><span class='material-symbols-outlined'>info</span> $m</div>";
            return $resp;
        }

        function msg_erro($m) {
            $resp = "<div class='erro'><span class='material-symbols-outlined'>error</span> $m</div>";
            return $resp;
        }
    ?>