<template>
  <div class="container">
    <div class="row">
        <div class="col-lg-12">
            <h4 class="page-header">Acccounts <span v-if="loading"><i class="fa fa-spinner fa-pulse fa-1x fa-fw"></i></span></h4>

        </div>
    </div>
      <div class="row">
          <div class="col-md-8">
            <notifications />
            <form class="form-horizontal">
              <div class="form-group">
                <label class="control-label col-sm-2" for="email">Email:</label>
                <div class="col-sm-10">
                  <input type="email" class="form-control" id="email" placeholder="Enter email">
                </div>
              </div>
              <div class="form-group">
                <label class="control-label col-sm-2" for="pwd">Password:</label>
                <div class="col-sm-10">
                  <input type="password" class="form-control" id="pwd" placeholder="Enter password">
                </div>
              </div>
              <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10">
                  <div class="checkbox">
                    <label><input type="checkbox"> Remember me</label>
                  </div>
                </div>
              </div>
              <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10">
                  <button type="submit" class="btn btn-default">Submit</button>
                </div>
              </div>
            </form>
          </div>
      </div>
  </div>
</template>
<script>
  export default {

  }
</script>
