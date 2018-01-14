<template>

        <div class="box box-info">
            <div class="box-header with-border">
            <h3 class="box-title">Learner Details</h3>
            </div>
            <!-- /.box-header -->
           <div class="box-body">
                        <!-- text input -->
                        <form @submit.prevent="save" @keydown="form.errors.clear($event.target.name)" @change="form.errors.clear($event.target.name)" role="form">
                        <inputform title="Surname" field="lastName" type="text" :form="form" :required="true"></inputform>

                        <inputform title="First Name" field="firstName" type="text" :form="form" :required="true"></inputform>

                        <selectform
                            title="Gender"
                            field = "gender"
                            :form = "form"
                            :items = "[{status:'Male'},{status:'Female'}]"
                            :names = "{value:'status',display:'status'}"
                            :required="true"
                        ></selectform>

                        <inputform title="Email" field="email" type="email" :form="form" :required="true"></inputform>

                        <inputform title="Phone" field="phone" type="text" :form="form"></inputform>

                        <textareaform title="Address" field="address" :form="form"></textareaform>

                        <inputform title="Postal Code" field="postalCode" type="text" :form="form"></inputform>

                        <inputform title="Relationship to applicant" field="relationship" type="text" :form="form" :required="true"></inputform>

                        <div class="form-group">
                            <button type="submit" class="btn btn-primary form-control">Submit</button>
                        </div>
                        </form>
                    </div>
                    <!-- /.box-body -->
            <!-- /.box-body -->
        </div>
</template>
<script>
  import {Form} from '../../services/form';
  import Input from '../../formComponents/Input';
  import Select from '../../formComponents/Select';
  import TextArea from '../../formComponents/TextArea';
  export default {
    props:['learner_user_id','editting'],
    components:{
      'inputform':Input,
      'selectform':Select,
      'textareaform':TextArea
    },
    data(){
      return {
        action:'post',
        url:'',
        action : 'post',
        user_id:'',
        form:new Form({
            firstName:'',
            lastName:'',
            gender:'',
            email:'',
            phone:'',
            address:'',
            postalCode:'',
            relationship:''
        })
      }
    },
    mounted(){
        this.url = '/gaurdians/'+this.learner_user_id;
        if(this.editting){
            var self = this;
            axios.get('/gaurdians/'+this.learner_user_id).then(function(result){
                var gaurdian = result.data[0];
                console.log(self.learner_user_id);
                console.log(result.data);
                self.form.edit(gaurdian);
                self.action = 'patch';
                self.url = '/gaurdians/'+gaurdian.id;
            });
        }
        console.log('Mounted');
    },
    methods:{
      save:function(){
        console.log(this.action+" -- "+this.url);
        var self = this;
        self.form.submit(this.action,this.url).then(function(result){
                if(result.exists){
                    alert(result.exists);
                }else{
                    console.log(result);
                    self.$emit("done");
                }
                //console.log(result);
        });
      }
    }
  }
</script>
