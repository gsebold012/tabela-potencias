<?php
// Parametro: string => $txt
// Retorno: string => "<td>$txt</td>"
function create_table_cell($txt){
  return("<td>$txt</td>");
}

// Parametro: vetor => $cells (colunas de uma linha da tabela)
// Retorno: string => "<tr><td>$cells[0]</td><td>$cells[1]</td>...</tr>
function create_table_row($cells){
  $table_row = "<tr>";
  foreach($cells as $key => $value){
    $table_row .= create_table_cell($value);
  }
  $table_row .= "</tr>";
  return($table_row);
}

// Parametro: matriz => $rows (linhas e celulas da tabela)
// Retorno: string => "<table class='table'><tr><td>$rows[0][0]</td><td>$rows[0][1]</td>...</tr><tr><td>$rows[1][0]</td><td>$rows[1][1]</td>...</tr>...</table>"
function create_table($rows){
  $table = '<table class="table">';
  foreach ($rows as $key => $value){
    $table .= create_table_row($value);
  }
  $table .= "</table>";
  return ($table);
}

// Parâmetro: inteiro => $r (número de linhas da matriz), $n (número de colunas da matriz)
// Retorno: matriz ($r x $n)
function power_matrix($r, $n){
  $arr = array();
  for($c = 0; $c < $r; $c++){
    $arr[] = array();
    for($x = 0; $x < $n; $x++){
      $arr[$c][$x] = pow($c+1, $x+1);
    }
  }
  return($arr);
}
?>
<!DOCTYPE html>
<html>
<head>
  <title>Teste PHP</title>
  <meta charset="utf-8">
  <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
  <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
</head>
<body>
<div class="container">
  <form id="form-test" class="form-horizontal" method="POST" action="<?= htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
    <div class="form-group">
      <label for="inputRow" class="col-sm-2 control-label">Numero de linhas: </label>
      <div class="col-sm-10">
        <input required type="number" class="form-control" name="row" placeholder="Número de Linhas">
      </div>
    </div>
    <div class="form-group">
      <label for="inputCol" class="col-sm-2 control-label">Numero de colunas: </label>
      <div class="col-sm-10">
        <input required type="number" class="form-control" name="col" placeholder="Número de Colunas">
      </div>
    </div>
    <div class="col-sm-offset-2 col-sm-10">
      <button type="submit" class="btn btn-default">Enviar</button>
    </div>
  </form>
  <?php if ($_SERVER["REQUEST_METHOD"] == "POST"): ?>
    <h1>Tabela de potências</h1>
    <?php
    $r = intval($_POST['row']);
    $c = intval($_POST['col']);
    $m = power_matrix($r, $c);
    echo create_table($m);
    ?>
    <?php endif; ?>
</div>
</body>
</html>

