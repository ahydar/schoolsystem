<template>
    <div class="container">
      <div class="row">
          <div class="col-lg-12">
              <h4 class="page-header">Classes</h4>
          </div>
      </div>
        <div class="row">
            <div class="col-md-8">
                <crudtable
                :columns="columns" :items="items" newBtn="New Class" :table="table"
                @add = "formAction" @edit = "formAction" @remove="removeCheck"
                ></crudtable>
                <notifications />

                <modal modalID="myModal">
                  <div slot="header"><h3>{{action}}</h3></div>
                  <div slot="body">
                    <form @submit.prevent="save" @keydown="form.errors.clear($event.target.name)" @change="form.errors.clear($event.target.name)">
                        <div class="form-group">
                          <label for="usr">Class Name:</label>
                          <input class="form-control" name='formName' v-model="form.formName">
                          <span style="color:red;" v-text="form.errors.get('formName')"></span>
                        </div>

                        <div class="form-group">
                          <label for="sel1">Grade:</label>
                          <select class="form-control" name='grade_id' v-model="form.grade_id">
                            <option v-for="grade in grades" v-bind:value="grade.id">
                              {{ grade.gradeName }} - {{grade.accountName}}
                            </option>
                          </select>
                          <span style="color:red;" v-text="form.errors.get('grade_id')"></span>
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
    import {dataTableLoad,destroyDataTable} from '../services/ajaxService';
    export default {
        extends:CrudCollection,
        components:{'crudtable':CrudTable},
        data(){
          return {
            form: new Form({
                formName:'',
                grade_id:''
            }),
            table:'classesTable',
            grades:[],
            url:'/classes',
            columns:[
              {title:'Class Name',field:'formName'},
              {title:'Grade',field:'gradeName'},
              {title:'Account',field:'accountName'}
            ]
          }
        },
        mounted() {

        },
        methods:{
          createTable:function(data){
            this.items = data.classes;
            this.grades = data.grades;
            dataTableLoad(this.table);
          }
        }
    }
</script>
