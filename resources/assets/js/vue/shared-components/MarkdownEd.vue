<template>
<div>
    <div class="card markdown-ed">
        <div class="card-header bg-light d-flex">
            <div>
                <button type="button" class="btn btn-outline-secondary btn-sm"><i class="far fa-h1"></i></button>
                <button type="button" class="btn btn-outline-secondary btn-sm"><i class="far fa-h2"></i></button>
                <button type="button" class="btn btn-outline-secondary btn-sm"><i class="far fa-link"></i></button>
                <button type="button" class="btn btn-outline-secondary btn-sm"><i class="far fa-image"></i></button>
            </div>
            <div class="ml-auto">
                <button type="button" class="btn btn-outline-secondary btn-sm">Preview <i class="far fa-eye"></i></button>
            </div>
        </div>
        <div class="card-body px-0 py-0">
            <textarea class="form-control" style="border: none; border-radius: 0" :id="modelName" :name="modelName" rows="6" placeholder="Content.."></textarea>
        </div>
    </div>
    <small>MarkdownEd! <span class="badge badge-danger">beta</span></small>
</div>
</template>

<script>
export default {
    props: ['modelName'],
    mounted () {
        console.log('MarkdownEd!')
    },
    created() {
        //
    },
};
</script>