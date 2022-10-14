<template>
    <form id="theForm" @submit.prevent="chooseState" class="modal-mask">
        <div class="modal-wrapper">
            <div class="modal-container">
                <div class="modal-header text-center text-2xl fond-bold">
                    <slot name="header">
                        {{ myTitle }}
                    </slot>
                </div>
                <div class="modal-body text-left">
                    <slot name="body">
                        <label for="image">Image Link</label>
                        <input type="text" id="image" name="image" v-model="entryData.image" required />
                        <label for="name">Name</label>
                        <input type="text" id="name" name="name" v-model="entryData.name" required />
                        <label for="email">Email</label>
                        <input type="text" id="email" name="email" v-model="entryData.email" required />
                        <label for="phone">Phone no.</label>
                        <input type="text" id="phone" name="phone" v-model="entryData.phone" required />
                        <label for="dependant">Dependant name</label>
                        <input type="text" id="dependant" name="dependant" v-model="entryData.dependant" required />
                        <label for="age">Age&nbsp;&nbsp;&nbsp;</label>
                        <input type="number" id="age" name="age" v-model="entryData.age" required />
                        <label for="department">Department</label>
                        <input type="text" id="department" name="department" v-model="entryData.department" required />
                    </slot>
                </div>

                <div class="modal-footer flex flex-row w-full">
                    <button class="modal-default-button" @click.prevent="$emit('close')">
                        Close
                    </button>
                    <button id="theForm" class="modal-default-button" @click="">
                        {{ submittionText }}
                    </button>
                </div>
            </div>
        </div>
    </form>
</template>

<script>
import axios from 'axios';

export default {
    name: 'modal',
    data() {
        return {
            entryData: {},
            submittionText: '',
        }
    },
    props: ['theData', 'theType', 'theId', 'myTitle'],
    mounted() {
        if (this.theType == "Create") {
            this.submittionText = "Create"
        } else if (this.theType == "Edit") {
            this.submittionText = "Edit"
            this.entryData = this.theData[this.theId]
        }
    },
    methods: {
        newEntry() {
            let clean = true;
            for (let oneData of this.theData) {
                if (oneData.name == this.entryData.name) {
                    alert("Duplicate entry found at: name")
                    clean = false
                }
                if (oneData.email == this.entryData.email) {
                    alert("Duplicate entry found at: email")
                    clean = false
                }
                if (oneData.phone == this.entryData.phone) {
                    alert("Duplicate entry found at: phone")
                    clean = false
                }
            }


            if (clean == true) {
                axios.post('/api/employees/store', JSON.parse(JSON.stringify(this.entryData))).then((response) => {
                    console.log(response)
                    document.getElementById("theForm").submit();
                }).catch((errors) => {
                    console.log(errors)
                }).finally(() => {
                    alert('Entry created successfully!')
                })
            }
        },
        updateEntry() {
            // delete this.entryData['id']
            axios.put('/api/employees/update/' + this.entryData['id'], JSON.parse(JSON.stringify(this.entryData))).then((response) => {
                console.log(response)
                document.getElementById("theForm").submit();
            }).catch((errors) => {
                console.log(errors)
            }).finally(() => {
                alert('Entry Edited successfully!')
            })
        },
        chooseState() {
            if (this.theType == 'Create') {
                this.newEntry()
            } else {
                this.updateEntry()
            }
        },
    }
}
</script>

<style scoped>
.modal-mask {
    position: fixed;
    z-index: 9998;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0, 0, 0, 0.5);
    display: table;
    transition: opacity 0.3s ease;
}

.modal-wrapper {
    display: table-cell;
    vertical-align: middle;
}

.modal-container {
    width: 50%;
    margin: 0px auto;
    padding: 20px 30px;
    background-color: #fff;
    border-radius: 2px;
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.33);
    transition: all 0.3s ease;
    font-family: Helvetica, Arial, sans-serif;
}

.modal-header h3 {
    margin-top: 0;
    color: #42b983;
}

.modal-body {
    margin: 20px 0;
}

.modal-default-button {
    /* float: right; */
    padding: 0.5em 2em 0.5em 2em;
    background-color: #42b983;
    border-radius: 1em;
    margin: auto;
    color: black;
    font-weight: bold;
    letter-spacing: 0.1em;
}

input {
    width: 100%;
}

/*
 * The following styles are auto-applied to elements with
 * transition="modal" when their visibility is toggled
 * by Vue.js.
 *
 * You can easily play with the modal transition by editing
 * these styles.
 */

.modal-enter-from,
.modal-leave-to {
    opacity: 0;
}

.modal-enter-active .modal-container,
.modal-leave-active .modal-container {
    -webkit-transform: scale(1.1);
    transform: scale(1.1);
}
</style>