<form method="POST" action="/subjects">
  {{ csrf_field() }}
  <!--{{ method_field('PATCH') }}-->
<input type="text" name="subjectName"><br><br>
<input type="text" name="account_id"><br><br>
<input type="submit">
</form>
