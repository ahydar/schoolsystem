<template>
    <div class="container">
      <div class="row">
          <div class="col-lg-12">
              <h4 class="page-header">Grades</h4>
          </div>
      </div>
        <div class="row">
            <div class="col-md-8">
                <crudtable
                :columns="columns" :items="items" newBtn="New Grade" :table="table"
                @add = "formAction" @edit = "formAction" @remove="removeCheck"
                ></crudtable>
                <notifications />

                <modal modalID="myModal">
                  <div slot="header"><h3>{{action}}</h3></div>
                  <div slot="body">
                    <form @submit.prevent="save" @keydown="form.errors.clear($event.target.name)" @change="form.errors.clear($event.target.name)">
                        <div class="form-group">
                          <label for="usr">Grade Name:</label>
                          <input class="form-control" name='gradeName' v-model="form.gradeName">
                          <span style="color:red;" v-text="form.errors.get('gradeName')"></span>
                        </div>


                        <div class="form-group">
                          <label for="sel1">Account:</label>
                          <select class="form-control" name='account_id' v-model="form.account_id">
                            <option v-for="account in accounts" v-bind:value="account.id">
                              {{ account.accountName }}
                            </option>
                          </select>
                          <span style="color:red;" v-text="form.errors.get('account_id')"></span>
                        </div>
                        <button type="submit" :disabled="form.errors.any()" class="btn btn-primary">Submit</button>
                    </form>
                  </div>
                </modal>

                <confirm
                message="Are you sure you want to remove this grade. Note: all classes and subjects linked to this class will be removed."
                btnClass="danger" v-on:confirmed="remove" :modalID="deleteModalId"></confirm>

            </div>
        </div>
    </div>
</template>

<script>
    import {Form} from '../services/form';
    import CrudCollection from '../components/CrudCollection';
    import CrudTable from '../components/CrudTable';
    import {dataTableLoad,destroyDataTable} from '../services/dataTablesService';
    export default {
        extends:CrudCollection,
        components:{'crudtable':CrudTable},
        data(){
          return {
            form: new Form({
                gradeName:'',
                account_id:''
            }),
            accounts:[],
            table:'gradeTable',
            url:'/grades',
            columns:[
              {title:'Grade Name',field:'gradeName'},
              {title:'Account Name',field:'accountName'}
            ]
          }
        },
        mounted() {

        },
        methods:{
          createTable:function(data){
            this.items = data.grades;
            this.accounts = data.accounts;
            dataTableLoad(this.table);
          }
        }
    }
</script>
