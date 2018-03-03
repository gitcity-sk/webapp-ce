<template>
<div class="row text-center loading" v-if="loading == false">
    <div class="col">
        <div class="loader" style="margin:0 auto;"></div>
    </div>
</div>
</template>

<script>
export default {
    props: ['loading'],
    created () {
        this.$on('pageLoader', function(value) {
            this.loading = value
        })
    }
}
</script>