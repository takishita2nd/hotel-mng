<template>
    <div class="details">
        <table>
            <tr>
                <td>
                    <select v-model="selectYear">
                        <option v-for="year in years" v-bind:value="year.value">{{ year.text }}</option>
                    </select>
                </td>
                <td>年</td>
                <td>
                    <select v-model="selectMonth">
                        <option v-for="month in months" v-bind:value="month.value">{{ month.text }}</option>
                    </select>
                </td>
                <td>月</td>
                    <select v-model="selectRoom">
                        <option v-for="room in rooms" v-bind:value="room.id">{{ room.name }}</option>
                    </select>
                </td>
            </tr>
        </table>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                selectYear: 2019,
                years:[ 
                    {text:'2019',value:2019},
                    {text:'2020',value:2020},
                ],
                selectMonth: 1,
                months:[ 
                    {text:'1',value:1},
                    {text:'2',value:2},
                    {text:'3',value:3},
                    {text:'4',value:4},
                    {text:'5',value:5},
                    {text:'6',value:6},
                    {text:'7',value:7},
                    {text:'8',value:8},
                    {text:'9',value:9},
                    {text:'10',value:10},
                    {text:'11',value:11},
                    {text:'12',value:12},
                ],
                selectRoom: 0,
                rooms: [],
                result: [],
            }
        },
        created: function() {
            this.getRooms();
        },
        methods: {
            getRooms: function() {
                var self = this;
                axios.post('/api/rooms').then(function(response){
                    response.data.roomLists.forEach(element => {
                        console.log(element.name)
                        self.rooms.push({id:element.id, name:element.name});
                    });
                }).catch(function(error){
                    console.log("失敗しました");
                });
            }
        }
    }
</script>
