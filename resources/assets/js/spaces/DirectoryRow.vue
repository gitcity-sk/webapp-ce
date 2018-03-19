<template>
<tr>
    <td><span class="mr-2"><i class="fas fa-folder"></i></span><a :href="'/' + directoryData.path" style="font-weight: 600" class="text-dark">{{ directoryData.name }}</a></td>
    <td> - </td>
    <td class="text-right">
        <span v-if="done">{{ directory.data.human_readable_size }}</span>
        <span class="text-secondary" v-else><i class="far fa-spinner-third fa-spin"></i></span>
    </td>
</tr>
</template>

<script>
    import axios from 'axios';
    import emojione from 'emojione';

    export default {
        mounted () {
            console.log('Component ProjectIssuesTable mounted.')
        },
        props: ['directoryData'],
        data () {
            return {
                done: false,
                directory: null,
                errors: []
            }
        },
        created () {
            axios.get('/api/spaces/size-of/' + this.directoryData.path)
            .then(response => {
                this.directory = response.data
                this.done = true
            })
            .catch(e => {
                this.errors.push(e)
            })
        }
    }
</script>