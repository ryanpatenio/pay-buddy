<!-- Modal --->
<div class="modal fade userModal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title" id="myLargeModalLabel">Create</h3>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="POST" id="userForm">
                    @csrf
                <div class="row mb-5">
                    <div class="col">
                      <label for="">Name</label>
                      <input type="text" class="form-control"  placeholder="Name" name="name" required>
                    </div>
                    <div class="col">
                        <label for="">Email | Username</label>
                        <input type="email" class="form-control"  placeholder="Email"  name="email" required>
                      </div>
                </div>
                <div class="row mb-5">
                    <div class="col">
                      <label for="">Password</label>
                      <input type="password" class="form-control" placeholder="Password" name="password"  required>
                    </div>
                    <div class="col">
                        <label for="">Role</label>
                        <select name="role" id="role" class="form-control" required>
                            <option value="admin">Admin</option>
                            <option value="user">User</option>
                        </select>
                      </div>
                </div>

                <div class="modal-footer">
                    
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close </button >
                    <button type="submit" class="btn btn-primary">Save </button >
               </div >
            </form>
            </div>
        </div>
    </div>
</div>