<template>
<tr>
    <td> <a :href="'/spaces/' + spaceData.id" style="font-weight: 600" class="text-dark">{{ spaceData.name }}</a></td>
    <td><span v-if="done"> {{ space.data.human_readable_size }} </span></td>
</tr>
</template>

<script>
    import axios from 'axios';
    import emojione from 'emojione';

    export default {
        mounted () {
            console.log('Component ProjectIssuesTable mounted.')
        },
        props: ['spaceData'],
        data () {
            return {
                done: false,
                space: null,
                errors: []
            }
        },
        created () {
            axios.get('/api/spaces/' + this.spaceData.id + '/size')
            .then(response => {
                this.space = response.data
                this.done = true
            })
            .catch(e => {
                this.errors.push(e)
            })
        }
    }
</script>