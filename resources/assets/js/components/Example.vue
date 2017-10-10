<template>
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <div class="panel panel-default">
                    <div class="panel-heading">Example Component</div>

                    <div class="panel-body">
                        <h4>Table</h4>
                        <table  width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
                            <thead>
                              <tr>
                                <th>Name</th>
                                <th>Surname</th>
                              </tr>
                            </thead>
                            <!--<tfoot>
                              <tr>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th></th>
                              </tr>
                            </tfoot>-->
                            <tbody>
                              <tr>
                                  <td>Abdullah</td>
                                  <td>Haydar</td>
                              </tr>
                              <tr>
                                  <td>'Aqeela'</td>
                                  <td>Ishmail-Haydar</td>
                              </tr>
                              <tr>
                                  <td>Amatullah</td>
                                  <td>Bint Abdillah</td>
                              </tr>
                            </tbody>
                            </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        mounted() {
            $('#dataTables-example').DataTable({
                responsive: true
            });
            console.log('Component mounted.');
        }
    }
</script>
