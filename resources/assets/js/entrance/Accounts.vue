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
                          <form @submit.prevent="saveAccount" @keydown="form.errors.clear($event.target.name)">
                              <div class="form-group">
                                <label for="usr">Account Name:</label>
                                <input class="form-control" name='accountName' v-model="form.accountName">
                                <span style="color:red;" v-text="form.errors.get('accountName')"></span>
                              </div>

                              <div class="form-group">
                                <label for="usr">Account Type:</label>
                                <input class="form-control" name='accountType' v-model="form.accountType">
                                <span style="color:red;" v-text="form.errors.get('accountType')"></span>
                              </div>
                              <button type="submit" :disabled="form.errors.any()" class="btn btn-primary">Submit</button>
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
    import {dataTableLoad,destroyDataTable} from '../services/ajaxService';
    import {Form} from '../services/form';
    export default {
        data(){
          return {
            form: new Form({
                accountName:'',
                accountType:''
            }),
            accountTable:'accountTable',
            modal_id:'myModal',
            accounts:[]
          }
        },
        mounted() {
            var self = this;
            axios.get("/getaccounts").then(function(result){
                    self.accounts = result.data;
                    dataTableLoad(self.accountTable);
            });
            console.log('Component mounted.');
        },
        methods:{
          saveAccount:function(){
            var self = this;
            //var data = {accountName:this.form.accountName,accountType:this.form.accountType};
            destroyDataTable(self.accountTable);

            this.form.submit('post','/accounts').then(response => {
              console.log(response);
              self.accounts.push(response);
              console.log(self.accounts);
              dataTableLoad(self.accountTable);
              $("#"+self.modal_id).modal('hide');
            })

            .catch(error => console.log('something went wrong'));
          }
        }
    }
</script>
