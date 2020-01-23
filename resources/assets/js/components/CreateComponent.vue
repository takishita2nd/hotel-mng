<template>
    <div>
        <p v-if="error_flg == true" class="error">
            <ul>
                <li v-for="error in errors">{{ error }}</li>
            </ul>
        </p>
        <table class="edit">
            <tbody>
                <tr>
                    <th>名前</th>
                    <td v-if=role>{{ contents.name }}<button @click="openModal">検索</button></td>
                    <td v-else>{{ contents.name }}</td>
                </tr>
                <tr>
                    <th>住所</th>
                    <td>{{ contents.address }}</td>
                </tr>
                <tr>
                    <th>電話番号</th>
                    <td>{{ contents.phone }}</td>
                </tr>
                <tr>
                    <th>人数</th>
                    <td>
                        <select v-model=contents.num>
                            <option v-for="num in nums" v-bind:value="num.value">{{ num.text }}</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <th>宿泊部屋</th>
                    <td>
                        <select v-model="contents.roomid">
                            <option v-for="room in rooms" v-bind:value="room.id">{{ room.name }}</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <th>宿泊日数</th>
                    <td><input type="number" v-model=contents.days /></td>
                </tr>
                <tr>
                    <th>宿泊日</th>
                    <td><input type="date" v-model=contents.start_day /></td>
                </tr>
                <tr>
                    <th>チェックアウト</th>
                    <td>
                        <select v-model="contents.checkout">
                            <option v-for="time in timeList" v-bind:value="time.key">{{ time.value }}</option>
                        </select>
                    </td>
                </tr>
            </tbody>
        </table>
        <p><button @click="regist">登録</button></p>
        <div id="overlay" v-show="showContent">
            <div id="content">
                <p>名前<input type="text" v-model=param.search /></p>
                <table class="usersearch">
                    <tbody>
                        <tr>
                            <th class="name">名前</th>
                            <th class="address">住所</th>
                            <th class="phone">電話番号</th>
                        </tr>
                        <tr v-for="user in users" @click="selectUser(user)">
                            <td class="name">{{ user.name }}</td>
                            <td class="address">{{ user.address }}</td>
                            <td class="phone">{{ user.phone }}</td>
                        </tr>
                    </tbody>
                </table>
            <p>
                <button @click="closeModal">close</button>
                <button @click="searchUsers">検索</button>
            </p>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                role: false,
                errors: [],
                error_flg:false,
                nums: [
                    {text:'1', value:1},
                    {text:'2', value:2}
                ],
                timeList:[],
                rooms: [],
                users: [],
                showContent: false,
                param: {
                    search: "",
                },
                contents: {
                    id: 0,
                    name: "",
                    address: "",
                    phone: "",
                    num: 0,
                    roomid: 0,
                    room: "",
                    days: 0,
                    start_day: "",
                    checkout: "",
                },
            }
        },
        created: function() {
            this.getRole();
            this.getRooms();
            this.getTimeList();
        },
        methods: {
            getRole: function() {
                var self = this;
                axios.post('/api/role').then(function(response){
                    self.role = response.data.role;
                    if(self.role == false){
                        self.contents.id = response.data.user.id;
                        self.contents.name = response.data.user.name;
                        self.contents.address = response.data.user.address;
                        self.contents.phone = response.data.user.phone;
                    }
                }).catch(function(error){
                    console.log("失敗しました");
                });
            },
            searchUsers: function() {
                this.users = [];
                var self = this;
                axios.post('/api/users', this.param).then(function(response){
                    response.data.users.forEach(element => {
                        self.users.push({id:element.id, name:element.name, address:element.address, phone:element.phone});
                    });
                }).catch(function(error){
                    console.log("失敗しました");
                });
            },
            selectUser: function(user) {
                this.contents.id = user.id;
                this.contents.name = user.name;
                this.contents.address = user.address;
                this.contents.phone = user.phone;
                this.closeModal();
            },
            validate: function(){
                var ret = true;
                this.errors = [];
                if(this.contents.id == 0) {
                    this.errors.push("ユーザーが選択されていません");
                    ret = false;
                }
                if(this.contents.num == 0) {
                    this.errors.push("人数が選択されていません");
                    ret = false;
                }
                if(this.contents.roomid == 0) {
                    this.errors.push("部屋が選択されていません");
                    ret = false;
                }
                if(this.contents.days == 0) {
                    this.errors.push("宿泊日数が入力されていません");
                    ret = false;
                }
                if(this.contents.start_day == "") {
                    this.errors.push("宿泊日が入力されていません");
                    ret = false;
                }
                if(this.contents.checkout == "") {
                    this.errors.push("チェックアウト時刻が入力されていません");
                    ret = false;
                }
                return ret;
            },
            regist: function() {
                if(this.validate() == false){
                    this.error_flg = true;
                    return;
                }
                var self = this;
                this.param.contents = this.contents;
                axios.post('/api/add', this.param).then(function(response){
                    document.location = "/management";
                }).catch(function(error){
                    self.error_flg = true;
                    self.error_message = error.response.data.errors;
                    console.log("失敗しました");
                });
            },
            getRooms: function() {
                var self = this;
                axios.post('/api/rooms').then(function(response){
                    response.data.roomLists.forEach(element => {
                        self.rooms.push({id:element.id, name:element.name});
                    });
                }).catch(function(error){
                    console.log("失敗しました");
                });
            },
            getTimeList: function(){
                var self = this;
                axios.post('/api/timelist').then(function(response){
                    for (let [key, value] of Object.entries(response.data.timelist)){
                        self.timeList.push({key: key, value: value});
                    }
                }).catch(function(error){
                    console.log("失敗しました");
                });
            },
            openModal: function(){
                this.users = [];
                this.showContent = true;
            },
            closeModal: function(){
                this.showContent = false;
                this.edit_flg = false;
            },
        }
    }
</script>
