<template>
  <div>
      <div class="row">
          <div class="col-md-12">
              <modal modalID="myModal">
                <div slot="header">
                  <h4>{{modalHeading}}</h4>
                </div>
                <div slot="body">
                  <form class="form-horizontal" @submit.prevent="save" @keydown="form.errors.clear($event.target.name)">
                      <div class="form-group">
                        <label class="control-label col-sm-3" for="usr">
                            <span class="pull-left">Amount:</span>
                            </label>
                        <div class="col-sm-offset-1 col-sm-6">
                            <input class="form-control" size="3" name='amount' v-model="form.amount">
                            <span style="color:red;" v-text="form.errors.get('amount')"></span>
                        </div>
                      </div>

                      <div class="form-group">
                        <label class="control-label col-sm-3" for="usr">
                            <span class="pull-left">Description:</span>
                        </label>
                        <div class="col-sm-offset-1 col-sm-6">
                            <input class="form-control" name='description' v-model="form.description">
                            <span style="color:red;" v-text="form.errors.get('description')"></span>
                        </div>
                      </div>

                      <div class="form-group">
                        <label class="control-label col-sm-3" for="usr">
                               <span class="pull-left"> Receipt no.:</span>
                        </label>
                        <div class="col-sm-offset-1 col-sm-6">
                            <input class="form-control" name='receiptNumber' v-model="form.receiptNumber">
                            <span style="color:red;" v-text="form.errors.get('receiptNumber')"></span>
                        </div>
                      </div>

                      <div class="form-group">
                        <label class="control-label col-sm-3" for="usr">
                            <span class="pull-left">Payment Date:</span>
                        </label>
                        <div class="col-sm-offset-1 col-sm-6">
                            <input class="form-control" name='paymentDate' v-model="form.paymentDate">
                            <span style="color:red;" v-text="form.errors.get('paymentDate')"></span>
                        </div>
                      </div>

                      <button type="submit"  class="btn btn-primary">Save</button>
                  </form>
                </div>
              </modal>
              <div class="panel panel-default">
                  <div class="panel-heading"></div>
                  <div class="panel-body">
                        <table width="100%" class=" table table-bordered table-hover" :id="tableID">
                            <thead>
                                <tr>
                                    <th></th>
                                    <th>Surname, Name</th>
                                    <th v-for="p in maxPayments">P{{p}}</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="learner in learners">
                                    <td>
                                        <button class="btn btn-primary btn-xs" @click="add(learner.id,learner.firstName,learner.lastName)">
                                            <i class="fa fa-plus" aria-hidden="true"></i> Add
                                        </button>
                                    </td>
                                    <td>
                                        {{learner.lastName}}, {{learner.firstName}}
                                    </td>
                                    <td v-for="fin in learner.finance">
                                            <button class="btn btn-success btn-xs" 
                                            @click="edit(learner.firstName,learner.lastName,fin)">
                                                {{fin.amount}}
                                            </button>
                                    </td>
                                    <td v-if="learner.finance.length < maxPayments" 
                                    v-for="p in maxPayments -learner.finance.length">

                                    </td>
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
import {dataTableLoad,destroyDataTable} from '../services/dataTablesService';
import {Form} from '../services/form';
export default {
    data(){
        return{
            id:'',
            tableID:'financeTable',
            learners:[],
            maxPayments:0,
            modalHeading:'',
            editting:false,
            form: new Form({
                user_id:0,
                amount:'',
                receiptNumber:'',
                paymentDate:'',
                description:''
            }),
        }
    },
    mounted(){
            this.$root.pageHead = "Finance Management";
            axios.get('/finance').then(result =>{
                console.log(result.data);
                this.learners = result.data.learners;
                this.maxPayments = result.data.maxPayments;
                dataTableLoad(this.tableID);
            },this);
    },
    methods:{
            add:function(user_id,firstName,lastName){
                this.modalHeading = "Add Payment for: "+firstName +" "+lastName;
                this.form.reset();
                this.form.user_id = user_id;
                this.editting = false;
                $("#myModal").modal('show');
            },
            edit:function(firstName,lastName,payment){
                this.modalHeading = "Edit Payment for: "+firstName +" "+lastName;
                this.form.reset();
                this.form.edit(payment);
                this.editting = true;
                this.id = payment.id;
                $("#myModal").modal('show');
            },
            save:function(){
                if(!this.editting){
                    this.form.submit('post','finance').then(result =>{
                        this.learners.forEach(element => {
                            if(element.id == result.user_id){
                                element.finance.push(result);
                                if(element.finance.length > this.maxPayments){
                                    this.maxPayments = this.maxPayments + 1;
                                }
                            }
                        });
                        destroyDataTable(this.tableID);
                        dataTableLoad(this.tableID);
                        $("#myModal").modal('hide');
                    },this);
                }else{
                    this.form.submit('patch','finance/'+this.id).then(result =>{
                        var outerIndex = 0;
                        var innerIndex = 0;
                        var outerIndex = this.learners.findIndex(element => {
                                return element.id == result.user_id
                        });

                        var innerIndex = this.learners[outerIndex].finance.findIndex(element => {
                                return element.id == result.id;
                        });
                        this.learners[outerIndex].finance.splice(innerIndex,1,result);
                        destroyDataTable(this.tableID);
                        dataTableLoad(this.tableID);
                        $("#myModal").modal('hide');
                    }),this;
                }
            }
    }
}
</script>

