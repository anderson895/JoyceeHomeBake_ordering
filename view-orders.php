<?php 
	include_once("include/nav.php");
	// cart();
	include_once("db.php");
	if(isset($_SESSION['user'])&&$_SESSION['user']==1){
		header("Location:logout.php");
	}
?>
	
	
<?php
if(isset($_SESSION['user'])&&$_SESSION['user']=='0')
{
	include_once("view_order-user.php");	
	
}else{
	$_SESSION['message']="You must login to see orders.";
	header("Location: index.php");
}
?>
		</div>
	</div>
</div>



<!-- Modal -->
<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title text-center">Login</h4>
      </div>
      <div class="modal-body">
        <input type="text" name="user" class="form-control" placeholder="Input Username" style="margin-bottom: 2%;" required>
		<input type="password" name="pass" class="form-control" placeholder="Input Password" required>
      </div>
      <div class="modal-footer">
		<button type="submit" name="login" class="btn btn-success">Login</button>
			
        <button type="button" class="btn btn-primary" data-dismiss="modal">Cancel</button>
      </div>
	  </form>
    </div>
	
  </div>
</div>
</body>
</html>