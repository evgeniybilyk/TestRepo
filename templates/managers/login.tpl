{if $redirect}
{literal}
    <script>
        document.location = "admin.php?page=hotel";
    </script>
{/literal}
{/if}

<form action="admin.php?page={$page}" method="post">
    <label>Login<input type="text" name="login"></label><br>
    <label>Password<input type="password" name="passwd"></label><br>
    <input type="submit" name="submit" value="Submit">
</form>
