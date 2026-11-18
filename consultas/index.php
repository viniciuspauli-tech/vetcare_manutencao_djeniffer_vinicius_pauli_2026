
<form method="post" action="excluir.php"
      onsubmit="return confirm('Deseja excluir esta consulta?')"
      style="display:inline">
    <input type="hidden" name="id" value="<?= $r['id'] ?>">
    <button type="submit">Excluir</button>
</form>
