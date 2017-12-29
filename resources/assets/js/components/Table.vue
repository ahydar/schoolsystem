<template>
<div>
    <table  width="100%" class=" table table-bordered table-hover" v-bind:id="tableID">
        <slot name='head'></slot>
        <slot name='body'></slot>
    </table>
</div>
</template>

<script>
export default {
    props:['tableID']
}

</script>
