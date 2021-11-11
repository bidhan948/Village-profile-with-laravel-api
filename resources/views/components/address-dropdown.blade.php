<script src="{{ asset('vue/bundle.js') }}"></script>
<script src="https://unpkg.com/vue-multiselect@2.1.0"></script>
<link rel="stylesheet" href="https://unpkg.com/vue-multiselect@2.1.0/dist/vue-multiselect.min.css">
<div class="row" id="app">
    <div class="col-4">
        <div class="input-group input-group-sm" style="max-height:50px;">
            <div class="input-group-prepend">
                <span class="input-group-text custom-group-prepend"
                    style="height:40px !important; width:70px !important;">
                    {{ __('प्रदेश') }}
                </span>
            </div>
            <div id="province">
                <multiselect v-model="province_id" :options="provinces" :close-on-select="true" :clear-on-select="true"
                    :hide-selected="false" :preserve-search="true" placeholder="--प्रदेश छान्नुहोस्--"
                    label="NepaliName" track-by="id" :preselect-first="true" id="example" @select="onSelect">
                </multiselect>
                <pre class="language-json"><code></code></pre>
            </div>
        </div>
    </div>
    <div class="col-4">
        <div class="input-group input-group-sm" style="max-height:50px;">
            <div class="input-group-prepend">
                <span class="input-group-text" style="height:40px !important; width:70px !important;">
                    {{ __('जिल्ला') }}
                </span>
            </div>
            <div id="district">
                <multiselect v-model="district_id" :options="districts" :close-on-select="true" :clear-on-select="true"
                    :hide-selected="false" :preserve-search="true" placeholder="--जिल्ला छान्नुहोस्--"
                    label="NepaliName" track-by="id" :preselect-first="true" id="example" @select="onSelectDistrict">
                </multiselect>
                <pre class="language-json"><code></code></pre>
            </div>
        </div>
    </div>
    <div class="col-4">
        <div class="input-group input-group-sm" style="max-height:50px;">
            <div class="input-group-prepend">
                <span class="input-group-text" style="height:40px !important; width:85px !important;">
                    {{ __('गा.पा/ना.पा') }}
                </span>
            </div>
            <div id="district">
                <multiselect v-model="municipality_id" :options="municipalities" :close-on-select="true"
                    :clear-on-select="true" :hide-selected="false" :preserve-search="true"
                    placeholder="--गा.पा/ना.पा छान्नुहोस्--" label="NepaliName" track-by="id" :preselect-first="true"
                    id="example" @select="onSelectMunicipality">
                </multiselect>
                <pre class="language-json"><code></code></pre>
            </div>
        </div>
    </div>
    <input v-model="po_id" type="hidden" id="province_id" name="province_id">
    <input v-model="di_id" type="hidden" id="district_id" name="district_id">
    <input v-model="mun_id" type="hidden" id="municipality_id" name="municipality_id">
</div>

<script>
    new Vue({
        components: {
            Multiselect: window.VueMultiselect.default
        },
        data: {
            provinces: [],
            province_id: '',
            po_id: '',
            di_id: '',
            mun_id: '',
            district_id: '',
            municipality_id: '',
            options: [],
            districts: [],
            municipalities: []
        },
        methods: {
            getAllProvince() {
                let vm = this;
                axios.get("{{ route('api.address') }}", {
                        params: {
                            type: "province",
                        }
                    })
                    .then(function(response) {
                        vm.provinces = response.data.provinces;
                    })
                    .catch(function(error) {
                        console.log(error);
                        alert("Some Problem Occured");
                    });
            },
            customLabel(option) {
                return `${option.library} - ${option.language}`
            },
            onSelect(provinces) {
                let vm = this;
                axios.get("{{ route('api.address') }}", {
                        params: {
                            province_id: provinces.id
                        }
                    })
                    .then(function(response) {
                        vm.po_id = provinces.id;
                        vm.districts = response.data.districts;
                    })
                    .catch(function(error) {
                        console.log(error);
                        alert("Some Problem Occured");
                    });
            },
            onSelectDistrict(districts) {
                let vm = this;
                axios.get("{{ route('api.address') }}", {
                        params: {
                            district_id: districts.id
                        }
                    })
                    .then(function(response) {
                        vm.di_id = districts.id;
                        vm.municipalities = response.data.municipalities;
                    })
                    .catch(function(error) {
                        console.log(error);
                        alert("Some Problem Occured");
                    });
            },
            onSelectMunicipality(municipalities) {
                let vm = this;
                vm.mun_id = municipalities.id;
            }
        },
        mounted() {
            let vm = this;
            vm.getAllProvince();
        }
    }).$mount('#app')
</script>
