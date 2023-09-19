<div class="row justify-content-center">
    <div class="col-md-7 col-sm-10">
        <div class="card card-body">
            <h3>Register new User</h3>
            <form action="" method="post">
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="name">Name</label>
                        <input type="text" placeholder="Enter the name" name="name" id="name" class="form-control">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="username">Username</label>
                        <select name="gender" id="gender" class="form-control">
                            <option value="">-- Select --</option>
                            <option value="male">Male</option>
                            <option value="female">Female</option>
                        </select>
                    </div>
                    <div class="form-group col-md-12">
                        <label for="email">Email</label>
                        <input type="email" name="email" id="email" placeholder="E-mail@example.com"
                            class="form-control">
                    </div>

                </div>

                <div class="form-group my-3">
                    <button type="submit" class="btn btn-primary">Register</button>
                </div>
            </form>
        </div>
    </div>
</div>