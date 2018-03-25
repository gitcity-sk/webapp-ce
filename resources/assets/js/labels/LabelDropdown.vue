<template>
    <div v-if="done" class="dropdown">
        <span id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="text-secondary">
            <i class="fal fa-pencil"></i>
        </span>
        <div class="dropdown-menu dropdown-menu-right" style="width: 270px" aria-labelledby="dropdownMenuButton">
            <h6 class="dropdown-header">Assign labels</h6>
            <div class="dropdown-divider"></div>
            <div class="form-group p-3 mb-2">
                <input type="email" class="form-control form-control-sm" id="exampleDropdownFormEmail1" placeholder="search">
            </div>
            <div class="badges-dropdown-list">
                <a v-for="label in labels.data" class="dropdown-item border-top" href="#" @click.prevent="attachLabel(label.id)">
                    <span :class="'badge ' + label.color + ' mr-2'"><i class="far fa-tag"></i></span> {{ label.text }}
                </a>
            </div>
            <div class="dropdown-divider"></div>
        </div>
    </div>
</template>

<script>
import axios from 'axios'

export default {
    props: ['issueId', 'parentLabels'],
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
        axios.get('/api/labels')
        .then(response => {
            this.labels = response.data;
            this.done = true
        })
        .catch(e => {
            this.errors.push(e)
        })
    },

    methods: {
        attachLabel: function (id) {
            console.log(id);

            axios.post('/api/issues/' + this.issueId + '/labels/' + id)
            .then(response => {
                this.$parent.$emit('badgesUpdated', true)
            })
            .catch(e => {
                this.errors.push(e)
            })
        },

        contains: function(id) {
            this.parentLabels.forEach(element => {
                if (element.id === id) return true;
            });

            return false;
        }
    }
};
</script>