<template>
<div class="form-group row">
    <div class="col-12">
        <label for="label">Label</label>
    </div>
    <div class="col-9">
        <select class="form-control" name="label_id" id="label">
            <option v-for="item in labels.data" :value="item.id">{{ item.text }}</option>
        </select>
    </div>
</div>
</template>

<script>
import axios from 'axios'

export default {
    data () {
        return {
            done: false,
            value: [],
            labels: {
                data: []
            },
            errors: []
        }
    },

    created () {
        axios.get('/api/labels?format=list')
        .then(response => {
            this.labels = response.data;
            this.done = true
        })
        .catch(e => {
            this.errors.push(e)
        })
    },
};
</script>