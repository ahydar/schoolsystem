<template>
    <div>
        <div class="row">
            <div class="col-md-4">
                <div class="input-group date" data-provide="datepicker">
                    <input type="text" class="form-control">
                    <div class="input-group-addon">
                        <span class="glyphicon glyphicon-th"></span>
                    </div>
                </div>
            </div>
         </div>
          <div class="row">
            <div class="col-md-12">

            </div>
         </div>
    </div>
</template>

<script>
export default {
    data(){
        return{

        }
    },
    created() {
          this.$root.pageHead = "Learner Daily Attendance";
    },
    mounted(){

    },
    methods:{
    }
}
</script>

