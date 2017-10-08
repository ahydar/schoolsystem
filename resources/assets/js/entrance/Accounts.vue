<template>
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <div class="panel panel-default">
                    <div class="panel-heading">
                      <button class="btn btn-primary" data-toggle="modal" data-target="#myModal">New Account</button>
                    </div>

                    <div class="panel-body">
                      <modal modalID="myModal">
                        <div slot="header"><h3>New Account</h3></div>
                        <div slot="body">
                            <form>
                              <div class="form-group">
                                <label for="usr">Account Name:</label>
                                <input class="form-control" v-model="accountName">
                              </div>
                              <button class="btn btn-primary" @click="btn">summi</button>
                            </form>
                        </div>
                      </modal>

                      <datatable :tableID="accountTable">
                          <thead slot="head">
                            <tr>
                              <th>Account Name</th>
                              <th>Account Type</th>
                            </tr>
                          </thead>
                          <tbody slot="body">
                            <tr v-for="account in accounts">
                                <td>{{account.accountName}}</td>
                                <td>{{account.accountType}}</td>
                            </tr>
                          </tbody>
                      </datatable>

                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import {getFunction} from '../services/ajaxcalls';
    export default {
        data(){
          return {
            accountTable:'accountTable',
            modal_id:'myModal',
            accountName:'Name',
            accountType:'',
            accounts:[]
          }
        },
        mounted() {
            getFunction("abdullah");
            var self = this;
            console.log('Component mounted.');
            $.ajax({url: '/getaccounts',
            success:function(result){
                console.log(result);
                self.accounts = result;
                $(document).ready(function(){
                  $('#'+self.accountTable).DataTable({
                      responsive: true
                  });
                });
            }});
        },
        methods:{
          btn:function(){
            alert('hello');
          }
        }
    }
</script>
