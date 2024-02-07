<script setup>
import { ref, defineEmits, onMounted } from 'vue';
import SelectInput from '@/Components/SelectInput.vue';
import InputLabel from '@/Components/InputLabel.vue';
import InputError from '@/Components/InputError.vue';

const props = defineProps(['lang',  'fieldName', 'valueField', 'selectedEnDistrict', 'selectedEnUpazila', 'selectedBnDistrict', 'selectedBnUpazila']);

const emit = defineEmits();


const selectedDistrictEn = ref({ id: '', name: '' });
const selectedDistrictBn = ref({ id: '', name: '' });
const selectedUpazilaEn = ref({ id: '', name: '' });
const selectedUpazilaBn = ref({ id: '', name: '' });

const districtsEn = [
    {
        "id": 1,
        "name": "Bagerhat",
        "upazilas": [
            {
                "id": 1,
                "name": "Fakirhat"
            },
            {
                "id": 2,
                "name": "Sadar"
            },
            {
                "id": 3,
                "name": "Mollahat"
            },
            {
                "id": 4,
                "name": "Sarankhola"
            },
            {
                "id": 5,
                "name": "Rampal"
            },
            {
                "id": 6,
                "name": "Morrelganj"
            },
            {
                "id": 7,
                "name": "Kachua"
            },
            {
                "id": 8,
                "name": "Mongla"
            },
            {
                "id": 9,
                "name": "Chitalmari"
            }
        ]
    },
    {
        "id": 2,
        "name": "Bandarban",
        "upazilas": [
            {
                "id": 1,
                "name": "Sadar"
            },
            {
                "id": 2,
                "name": "Alikadam"
            },
            {
                "id": 3,
                "name": "Naikhongchhari"
            },
            {
                "id": 4,
                "name": "Rowangchhari"
            },
            {
                "id": 5,
                "name": "Lama"
            },
            {
                "id": 6,
                "name": "Ruma"
            },
            {
                "id": 7,
                "name": "Thanchi"
            }
        ]
    },
    {
        "id": 3,
        "name": "Barguna",
        "upazilas": [
            {
                "id": 1,
                "name": "Amtali"
            },
            {
                "id": 2,
                "name": "Sadar"
            },
            {
                "id": 3,
                "name": "Betagi"
            },
            {
                "id": 4,
                "name": "Bamna"
            },
            {
                "id": 5,
                "name": "Pathorghata"
            },
            {
                "id": 6,
                "name": "Taltali"
            }
        ]
    },
    {
        "id": 4,
        "name": "Barishal",
        "upazilas": [
            {
                "id": 1,
                "name": "Barishalsadar"
            },
            {
                "id": 2,
                "name": "Bakerganj"
            },
            {
                "id": 3,
                "name": "Babuganj"
            },
            {
                "id": 4,
                "name": "Wazirpur"
            },
            {
                "id": 5,
                "name": "Banaripara"
            },
            {
                "id": 6,
                "name": "Gournadi"
            },
            {
                "id": 7,
                "name": "Agailjhara"
            },
            {
                "id": 8,
                "name": "Mehendiganj"
            },
            {
                "id": 9,
                "name": "Muladi"
            },
            {
                "id": 10,
                "name": "Hizla"
            }
        ]
    },
    {
        "id": 5,
        "name": "Bhola",
        "upazilas": [
            {
                "id": 1,
                "name": "Sadar"
            },
            {
                "id": 2,
                "name": "Borhanuddin"
            },
            {
                "id": 3,
                "name": "Charfesson"
            },
            {
                "id": 4,
                "name": "Doulatkhan"
            },
            {
                "id": 5,
                "name": "Monpura"
            },
            {
                "id": 6,
                "name": "Tazumuddin"
            },
            {
                "id": 7,
                "name": "Lalmohan"
            }
        ]
    },
    {
        "id": 6,
        "name": "Bogura",
        "upazilas": [
            {
                "id": 1,
                "name": "Kahaloo"
            },
            {
                "id": 2,
                "name": "Sadar"
            },
            {
                "id": 3,
                "name": "Shariakandi"
            },
            {
                "id": 4,
                "name": "Shajahanpur"
            },
            {
                "id": 5,
                "name": "Dupchanchia"
            },
            {
                "id": 6,
                "name": "Adamdighi"
            },
            {
                "id": 7,
                "name": "Nondigram"
            },
            {
                "id": 8,
                "name": "Sonatala"
            },
            {
                "id": 9,
                "name": "Dhunot"
            },
            {
                "id": 10,
                "name": "Gabtali"
            },
            {
                "id": 11,
                "name": "Sherpur"
            },
            {
                "id": 12,
                "name": "Shibganj"
            }
        ]
    },
    {
        "id": 7,
        "name": "Brahmanbaria",
        "upazilas": [
            {
                "id": 1,
                "name": "Sadar"
            },
            {
                "id": 2,
                "name": "Kasba"
            },
            {
                "id": 3,
                "name": "Nasirnagar"
            },
            {
                "id": 4,
                "name": "Sarail"
            },
            {
                "id": 5,
                "name": "Ashuganj"
            },
            {
                "id": 6,
                "name": "Akhaura"
            },
            {
                "id": 7,
                "name": "Nabinagar"
            },
            {
                "id": 8,
                "name": "Bancharampur"
            },
            {
                "id": 9,
                "name": "Bijoynagar"
            }
        ]
    },
    {
        "id": 8,
        "name": "Chandpur",
        "upazilas": [
            {
                "id": 1,
                "name": "Haimchar"
            },
            {
                "id": 2,
                "name": "Kachua"
            },
            {
                "id": 3,
                "name": "Shahrasti"
            },
            {
                "id": 4,
                "name": "Sadar"
            },
            {
                "id": 5,
                "name": "Matlabsouth"
            },
            {
                "id": 6,
                "name": "Hajiganj"
            },
            {
                "id": 7,
                "name": "Matlabnorth"
            },
            {
                "id": 8,
                "name": "Faridgonj"
            }
        ]
    },
    {
        "id": 9,
        "name": "Chapainawabganj",
        "upazilas": [
            {
                "id": 1,
                "name": "Chapainawabganjsadar"
            },
            {
                "id": 2,
                "name": "Gomostapur"
            },
            {
                "id": 3,
                "name": "Nachol"
            },
            {
                "id": 4,
                "name": "Bholahat"
            },
            {
                "id": 5,
                "name": "Shibganj"
            }
        ]
    },
    {
        "id": 10,
        "name": "Chattogram",
        "upazilas": [
            {
                "id": 1,
                "name": "Rangunia"
            },
            {
                "id": 2,
                "name": "Sitakunda"
            },
            {
                "id": 3,
                "name": "Mirsharai"
            },
            {
                "id": 4,
                "name": "Patiya"
            },
            {
                "id": 5,
                "name": "Sandwip"
            },
            {
                "id": 6,
                "name": "Banshkhali"
            },
            {
                "id": 7,
                "name": "Boalkhali"
            },
            {
                "id": 8,
                "name": "Anwara"
            },
            {
                "id": 9,
                "name": "Chandanaish"
            },
            {
                "id": 10,
                "name": "Satkania"
            },
            {
                "id": 11,
                "name": "Lohagara"
            },
            {
                "id": 12,
                "name": "Hathazari"
            },
            {
                "id": 13,
                "name": "Fatikchhari"
            },
            {
                "id": 14,
                "name": "Raozan"
            },
            {
                "id": 15,
                "name": "Karnafuli"
            }
        ]
    },
    {
        "id": 11,
        "name": "Chuadanga",
        "upazilas": [
            {
                "id": 1,
                "name": "Chuadangasadar"
            },
            {
                "id": 2,
                "name": "Alamdanga"
            },
            {
                "id": 3,
                "name": "Damurhuda"
            },
            {
                "id": 4,
                "name": "Jibannagar"
            }
        ]
    },
    {
        "id": 12,
        "name": "Coxsbazar",
        "upazilas": [
            {
                "id": 1,
                "name": "Sadar"
            },
            {
                "id": 2,
                "name": "Chakaria"
            },
            {
                "id": 3,
                "name": "Kutubdia"
            },
            {
                "id": 4,
                "name": "Ukhiya"
            },
            {
                "id": 5,
                "name": "Moheshkhali"
            },
            {
                "id": 6,
                "name": "Pekua"
            },
            {
                "id": 7,
                "name": "Ramu"
            },
            {
                "id": 8,
                "name": "Teknaf"
            }
        ]
    },
    {
        "id": 13,
        "name": "Cumilla",
        "upazilas": [
            {
                "id": 1,
                "name": "Debidwar"
            },
            {
                "id": 2,
                "name": "Barura"
            },
            {
                "id": 3,
                "name": "Brahmanpara"
            },
            {
                "id": 4,
                "name": "Chandina"
            },
            {
                "id": 5,
                "name": "Chauddagram"
            },
            {
                "id": 6,
                "name": "Daudkandi"
            },
            {
                "id": 7,
                "name": "Homna"
            },
            {
                "id": 8,
                "name": "Laksam"
            },
            {
                "id": 9,
                "name": "Muradnagar"
            },
            {
                "id": 10,
                "name": "Nangalkot"
            },
            {
                "id": 11,
                "name": "Cumillasadar"
            },
            {
                "id": 12,
                "name": "Meghna"
            },
            {
                "id": 13,
                "name": "Monohargonj"
            },
            {
                "id": 14,
                "name": "Sadarsouth"
            },
            {
                "id": 15,
                "name": "Titas"
            },
            {
                "id": 16,
                "name": "Burichang"
            },
            {
                "id": 17,
                "name": "Lalmai"
            }
        ]
    },
    {
        "id": 14,
        "name": "Dhaka",
        "upazilas": [
            {
                "id": 1,
                "name": "Savar"
            },
            {
                "id": 2,
                "name": "Dhamrai"
            },
            {
                "id": 3,
                "name": "Keraniganj"
            },
            {
                "id": 4,
                "name": "Nawabganj"
            },
            {
                "id": 5,
                "name": "Dohar"
            }
        ]
    },
    {
        "id": 15,
        "name": "Dinajpur",
        "upazilas": [
            {
                "id": 1,
                "name": "Nawabganj"
            },
            {
                "id": 2,
                "name": "Birganj"
            },
            {
                "id": 3,
                "name": "Ghoraghat"
            },
            {
                "id": 4,
                "name": "Birampur"
            },
            {
                "id": 5,
                "name": "Parbatipur"
            },
            {
                "id": 6,
                "name": "Bochaganj"
            },
            {
                "id": 7,
                "name": "Kaharol"
            },
            {
                "id": 8,
                "name": "Fulbari"
            },
            {
                "id": 9,
                "name": "Dinajpursadar"
            },
            {
                "id": 10,
                "name": "Hakimpur"
            },
            {
                "id": 11,
                "name": "Khansama"
            },
            {
                "id": 12,
                "name": "Birol"
            },
            {
                "id": 13,
                "name": "Chirirbandar"
            }
        ]
    },
    {
        "id": 16,
        "name": "Faridpur",
        "upazilas": [
            {
                "id": 1,
                "name": "Sadar"
            },
            {
                "id": 2,
                "name": "Alfadanga"
            },
            {
                "id": 3,
                "name": "Boalmari"
            },
            {
                "id": 4,
                "name": "Sadarpur"
            },
            {
                "id": 5,
                "name": "Nagarkanda"
            },
            {
                "id": 6,
                "name": "Bhanga"
            },
            {
                "id": 7,
                "name": "Charbhadrasan"
            },
            {
                "id": 8,
                "name": "Madhukhali"
            },
            {
                "id": 9,
                "name": "Saltha"
            }
        ]
    },
    {
        "id": 17,
        "name": "Feni",
        "upazilas": [
            {
                "id": 1,
                "name": "Chhagalnaiya"
            },
            {
                "id": 2,
                "name": "Sadar"
            },
            {
                "id": 3,
                "name": "Sonagazi"
            },
            {
                "id": 4,
                "name": "Fulgazi"
            },
            {
                "id": 5,
                "name": "Parshuram"
            },
            {
                "id": 6,
                "name": "Daganbhuiyan"
            }
        ]
    },
    {
        "id": 18,
        "name": "Gaibandha",
        "upazilas": [
            {
                "id": 1,
                "name": "Sadullapur"
            },
            {
                "id": 2,
                "name": "Gaibandhasadar"
            },
            {
                "id": 3,
                "name": "Palashbari"
            },
            {
                "id": 4,
                "name": "Saghata"
            },
            {
                "id": 5,
                "name": "Gobindaganj"
            },
            {
                "id": 6,
                "name": "Sundarganj"
            },
            {
                "id": 7,
                "name": "Phulchari"
            }
        ]
    },
    {
        "id": 19,
        "name": "Gazipur",
        "upazilas": [
            {
                "id": 1,
                "name": "Kaliganj"
            },
            {
                "id": 2,
                "name": "Kaliakair"
            },
            {
                "id": 3,
                "name": "Kapasia"
            },
            {
                "id": 4,
                "name": "Sadar"
            },
            {
                "id": 5,
                "name": "Sreepur"
            }
        ]
    },
    {
        "id": 20,
        "name": "Gopalganj",
        "upazilas": [
            {
                "id": 1,
                "name": "Sadar"
            },
            {
                "id": 2,
                "name": "Kashiani"
            },
            {
                "id": 3,
                "name": "Tungipara"
            },
            {
                "id": 4,
                "name": "Kotalipara"
            },
            {
                "id": 5,
                "name": "Muksudpur"
            }
        ]
    },
    {
        "id": 21,
        "name": "Habiganj",
        "upazilas": [
            {
                "id": 1,
                "name": "Nabiganj"
            },
            {
                "id": 2,
                "name": "Bahubal"
            },
            {
                "id": 3,
                "name": "Ajmiriganj"
            },
            {
                "id": 4,
                "name": "Baniachong"
            },
            {
                "id": 5,
                "name": "Lakhai"
            },
            {
                "id": 6,
                "name": "Chunarughat"
            },
            {
                "id": 7,
                "name": "Habiganjsadar"
            },
            {
                "id": 8,
                "name": "Madhabpur"
            },
            {
                "id": 9,
                "name": "Shayestaganj"
            }
        ]
    },
    {
        "id": 22,
        "name": "Jamalpur",
        "upazilas": [
            {
                "id": 1,
                "name": "Jamalpursadar"
            },
            {
                "id": 2,
                "name": "Melandah"
            },
            {
                "id": 3,
                "name": "Islampur"
            },
            {
                "id": 4,
                "name": "Dewangonj"
            },
            {
                "id": 5,
                "name": "Sarishabari"
            },
            {
                "id": 6,
                "name": "Madarganj"
            },
            {
                "id": 7,
                "name": "Bokshiganj"
            }
        ]
    },
    {
        "id": 23,
        "name": "Jashore",
        "upazilas": [
            {
                "id": 1,
                "name": "Manirampur"
            },
            {
                "id": 2,
                "name": "Abhaynagar"
            },
            {
                "id": 3,
                "name": "Bagherpara"
            },
            {
                "id": 4,
                "name": "Chougachha"
            },
            {
                "id": 5,
                "name": "Jhikargacha"
            },
            {
                "id": 6,
                "name": "Keshabpur"
            },
            {
                "id": 7,
                "name": "Sadar"
            },
            {
                "id": 8,
                "name": "Sharsha"
            }
        ]
    },
    {
        "id": 24,
        "name": "Jhalakathi",
        "upazilas": [
            {
                "id": 1,
                "name": "Sadar"
            },
            {
                "id": 2,
                "name": "Kathalia"
            },
            {
                "id": 3,
                "name": "Nalchity"
            },
            {
                "id": 4,
                "name": "Rajapur"
            }
        ]
    },
    {
        "id": 25,
        "name": "Jhenaidah",
        "upazilas": [
            {
                "id": 1,
                "name": "Sadar"
            },
            {
                "id": 2,
                "name": "Shailkupa"
            },
            {
                "id": 3,
                "name": "Harinakundu"
            },
            {
                "id": 4,
                "name": "Kaliganj"
            },
            {
                "id": 5,
                "name": "Kotchandpur"
            },
            {
                "id": 6,
                "name": "Moheshpur"
            }
        ]
    },
    {
        "id": 26,
        "name": "Joypurhat",
        "upazilas": [
            {
                "id": 1,
                "name": "Akkelpur"
            },
            {
                "id": 2,
                "name": "Kalai"
            },
            {
                "id": 3,
                "name": "Khetlal"
            },
            {
                "id": 4,
                "name": "Panchbibi"
            },
            {
                "id": 5,
                "name": "Joypurhatsadar"
            }
        ]
    },
    {
        "id": 27,
        "name": "Khagrachhari",
        "upazilas": [
            {
                "id": 1,
                "name": "Sadar"
            },
            {
                "id": 2,
                "name": "Dighinala"
            },
            {
                "id": 3,
                "name": "Panchari"
            },
            {
                "id": 4,
                "name": "Laxmichhari"
            },
            {
                "id": 5,
                "name": "Mohalchari"
            },
            {
                "id": 6,
                "name": "Manikchari"
            },
            {
                "id": 7,
                "name": "Ramgarh"
            },
            {
                "id": 8,
                "name": "Matiranga"
            },
            {
                "id": 9,
                "name": "Guimara"
            }
        ]
    },
    {
        "id": 28,
        "name": "Khulna",
        "upazilas": [
            {
                "id": 1,
                "name": "Paikgasa"
            },
            {
                "id": 2,
                "name": "Fultola"
            },
            {
                "id": 3,
                "name": "Digholia"
            },
            {
                "id": 4,
                "name": "Rupsha"
            },
            {
                "id": 5,
                "name": "Terokhada"
            },
            {
                "id": 6,
                "name": "Dumuria"
            },
            {
                "id": 7,
                "name": "Botiaghata"
            },
            {
                "id": 8,
                "name": "Dakop"
            },
            {
                "id": 9,
                "name": "Koyra"
            }
        ]
    },
    {
        "id": 29,
        "name": "Kishoreganj",
        "upazilas": [
            {
                "id": 1,
                "name": "Itna"
            },
            {
                "id": 2,
                "name": "Katiadi"
            },
            {
                "id": 3,
                "name": "Bhairab"
            },
            {
                "id": 4,
                "name": "Tarail"
            },
            {
                "id": 5,
                "name": "Hossainpur"
            },
            {
                "id": 6,
                "name": "Pakundia"
            },
            {
                "id": 7,
                "name": "Kuliarchar"
            },
            {
                "id": 8,
                "name": "Kishoreganjsadar"
            },
            {
                "id": 9,
                "name": "Karimgonj"
            },
            {
                "id": 10,
                "name": "Bajitpur"
            },
            {
                "id": 11,
                "name": "Austagram"
            },
            {
                "id": 12,
                "name": "Mithamoin"
            },
            {
                "id": 13,
                "name": "Nikli"
            }
        ]
    },
    {
        "id": 30,
        "name": "Kurigram",
        "upazilas": [
            {
                "id": 1,
                "name": "Kurigramsadar"
            },
            {
                "id": 2,
                "name": "Nageshwari"
            },
            {
                "id": 3,
                "name": "Bhurungamari"
            },
            {
                "id": 4,
                "name": "Phulbari"
            },
            {
                "id": 5,
                "name": "Rajarhat"
            },
            {
                "id": 6,
                "name": "Ulipur"
            },
            {
                "id": 7,
                "name": "Chilmari"
            },
            {
                "id": 8,
                "name": "Rowmari"
            },
            {
                "id": 9,
                "name": "Charrajibpur"
            }
        ]
    },
    {
        "id": 31,
        "name": "Kushtia",
        "upazilas": [
            {
                "id": 1,
                "name": "Kushtiasadar"
            },
            {
                "id": 2,
                "name": "Kumarkhali"
            },
            {
                "id": 3,
                "name": "Khoksa"
            },
            {
                "id": 4,
                "name": "Mirpurkushtia"
            },
            {
                "id": 5,
                "name": "Daulatpur"
            },
            {
                "id": 6,
                "name": "Bheramara"
            }
        ]
    },
    {
        "id": 32,
        "name": "Lakshmipur",
        "upazilas": [
            {
                "id": 1,
                "name": "Sadar"
            },
            {
                "id": 2,
                "name": "Kamalnagar"
            },
            {
                "id": 3,
                "name": "Raipur"
            },
            {
                "id": 4,
                "name": "Ramgati"
            },
            {
                "id": 5,
                "name": "Ramganj"
            }
        ]
    },
    {
        "id": 33,
        "name": "Lalmonirhat",
        "upazilas": [
            {
                "id": 1,
                "name": "Sadar"
            },
            {
                "id": 2,
                "name": "Kaliganj"
            },
            {
                "id": 3,
                "name": "Hatibandha"
            },
            {
                "id": 4,
                "name": "Patgram"
            },
            {
                "id": 5,
                "name": "Aditmari"
            }
        ]
    },
    {
        "id": 34,
        "name": "Madaripur",
        "upazilas": [
            {
                "id": 1,
                "name": "Sadar"
            },
            {
                "id": 2,
                "name": "Shibchar"
            },
            {
                "id": 3,
                "name": "Kalkini"
            },
            {
                "id": 4,
                "name": "Rajoir"
            },
            {
                "id": 5,
                "name": "Dasar"
            }
        ]
    },
    {
        "id": 35,
        "name": "Magura",
        "upazilas": [
            {
                "id": 1,
                "name": "Shalikha"
            },
            {
                "id": 2,
                "name": "Sreepur"
            },
            {
                "id": 3,
                "name": "Magurasadar"
            },
            {
                "id": 4,
                "name": "Mohammadpur"
            }
        ]
    },
    {
        "id": 36,
        "name": "Manikganj",
        "upazilas": [
            {
                "id": 1,
                "name": "Harirampur"
            },
            {
                "id": 2,
                "name": "Saturia"
            },
            {
                "id": 3,
                "name": "Sadar"
            },
            {
                "id": 4,
                "name": "Gior"
            },
            {
                "id": 5,
                "name": "Shibaloy"
            },
            {
                "id": 6,
                "name": "Doulatpur"
            },
            {
                "id": 7,
                "name": "Singiar"
            }
        ]
    },
    {
        "id": 37,
        "name": "Meherpur",
        "upazilas": [
            {
                "id": 1,
                "name": "Mujibnagar"
            },
            {
                "id": 2,
                "name": "Meherpursadar"
            },
            {
                "id": 3,
                "name": "Gangni"
            }
        ]
    },
    {
        "id": 38,
        "name": "Moulvibazar",
        "upazilas": [
            {
                "id": 1,
                "name": "Barlekha"
            },
            {
                "id": 2,
                "name": "Kamolganj"
            },
            {
                "id": 3,
                "name": "Kulaura"
            },
            {
                "id": 4,
                "name": "Moulvibazarsadar"
            },
            {
                "id": 5,
                "name": "Rajnagar"
            },
            {
                "id": 6,
                "name": "Sreemangal"
            },
            {
                "id": 7,
                "name": "Juri"
            }
        ]
    },
    {
        "id": 39,
        "name": "Munshiganj",
        "upazilas": [
            {
                "id": 1,
                "name": "Sadar"
            },
            {
                "id": 2,
                "name": "Sreenagar"
            },
            {
                "id": 3,
                "name": "Sirajdikhan"
            },
            {
                "id": 4,
                "name": "Louhajanj"
            },
            {
                "id": 5,
                "name": "Gajaria"
            },
            {
                "id": 6,
                "name": "Tongibari"
            }
        ]
    },
    {
        "id": 40,
        "name": "Mymensingh",
        "upazilas": [
            {
                "id": 1,
                "name": "Fulbaria"
            },
            {
                "id": 2,
                "name": "Trishal"
            },
            {
                "id": 3,
                "name": "Bhaluka"
            },
            {
                "id": 4,
                "name": "Muktagacha"
            },
            {
                "id": 5,
                "name": "Mymensinghsadar"
            },
            {
                "id": 6,
                "name": "Dhobaura"
            },
            {
                "id": 7,
                "name": "Phulpur"
            },
            {
                "id": 8,
                "name": "Haluaghat"
            },
            {
                "id": 9,
                "name": "Gouripur"
            },
            {
                "id": 10,
                "name": "Gafargaon"
            },
            {
                "id": 11,
                "name": "Iswarganj"
            },
            {
                "id": 12,
                "name": "Nandail"
            },
            {
                "id": 13,
                "name": "Tarakanda"
            }
        ]
    },
    {
        "id": 41,
        "name": "Naogaon",
        "upazilas": [
            {
                "id": 1,
                "name": "Mohadevpur"
            },
            {
                "id": 2,
                "name": "Badalgachi"
            },
            {
                "id": 3,
                "name": "Patnitala"
            },
            {
                "id": 4,
                "name": "Dhamoirhat"
            },
            {
                "id": 5,
                "name": "Niamatpur"
            },
            {
                "id": 6,
                "name": "Manda"
            },
            {
                "id": 7,
                "name": "Atrai"
            },
            {
                "id": 8,
                "name": "Raninagar"
            },
            {
                "id": 9,
                "name": "Naogaonsadar"
            },
            {
                "id": 10,
                "name": "Porsha"
            },
            {
                "id": 11,
                "name": "Sapahar"
            }
        ]
    },
    {
        "id": 42,
        "name": "Narail",
        "upazilas": [
            {
                "id": 1,
                "name": "Narailsadar"
            },
            {
                "id": 2,
                "name": "Lohagara"
            },
            {
                "id": 3,
                "name": "Kalia"
            }
        ]
    },
    {
        "id": 43,
        "name": "Narayanganj",
        "upazilas": [
            {
                "id": 1,
                "name": "Araihazar"
            },
            {
                "id": 2,
                "name": "Bandar"
            },
            {
                "id": 3,
                "name": "Narayanganjsadar"
            },
            {
                "id": 4,
                "name": "Rupganj"
            },
            {
                "id": 5,
                "name": "Sonargaon"
            }
        ]
    },
    {
        "id": 44,
        "name": "Narsingdi",
        "upazilas": [
            {
                "id": 1,
                "name": "Belabo"
            },
            {
                "id": 2,
                "name": "Monohardi"
            },
            {
                "id": 3,
                "name": "Narsingdisadar"
            },
            {
                "id": 4,
                "name": "Palash"
            },
            {
                "id": 5,
                "name": "Raipura"
            },
            {
                "id": 6,
                "name": "Shibpur"
            }
        ]
    },
    {
        "id": 45,
        "name": "Natore",
        "upazilas": [
            {
                "id": 1,
                "name": "Natoresadar"
            },
            {
                "id": 2,
                "name": "Singra"
            },
            {
                "id": 3,
                "name": "Baraigram"
            },
            {
                "id": 4,
                "name": "Bagatipara"
            },
            {
                "id": 5,
                "name": "Lalpur"
            },
            {
                "id": 6,
                "name": "Gurudaspur"
            },
            {
                "id": 7,
                "name": "Naldanga"
            }
        ]
    },
    {
        "id": 46,
        "name": "Netrokona",
        "upazilas": [
            {
                "id": 1,
                "name": "Barhatta"
            },
            {
                "id": 2,
                "name": "Durgapur"
            },
            {
                "id": 3,
                "name": "Kendua"
            },
            {
                "id": 4,
                "name": "Atpara"
            },
            {
                "id": 5,
                "name": "Madan"
            },
            {
                "id": 6,
                "name": "Khaliajuri"
            },
            {
                "id": 7,
                "name": "Kalmakanda"
            },
            {
                "id": 8,
                "name": "Mohongonj"
            },
            {
                "id": 9,
                "name": "Purbadhala"
            },
            {
                "id": 10,
                "name": "Netrokonasadar"
            }
        ]
    },
    {
        "id": 47,
        "name": "Nilphamari",
        "upazilas": [
            {
                "id": 1,
                "name": "Syedpur"
            },
            {
                "id": 2,
                "name": "Domar"
            },
            {
                "id": 3,
                "name": "Dimla"
            },
            {
                "id": 4,
                "name": "Jaldhaka"
            },
            {
                "id": 5,
                "name": "Kishorganj"
            },
            {
                "id": 6,
                "name": "Nilphamarisadar"
            }
        ]
    },
    {
        "id": 48,
        "name": "Noakhali",
        "upazilas": [
            {
                "id": 1,
                "name": "Sadar"
            },
            {
                "id": 2,
                "name": "Companiganj"
            },
            {
                "id": 3,
                "name": "Begumganj"
            },
            {
                "id": 4,
                "name": "Hatia"
            },
            {
                "id": 5,
                "name": "Subarnachar"
            },
            {
                "id": 6,
                "name": "Kabirhat"
            },
            {
                "id": 7,
                "name": "Senbug"
            },
            {
                "id": 8,
                "name": "Chatkhil"
            },
            {
                "id": 9,
                "name": "Sonaimuri"
            }
        ]
    },
    {
        "id": 49,
        "name": "Pabna",
        "upazilas": [
            {
                "id": 1,
                "name": "Sujanagar"
            },
            {
                "id": 2,
                "name": "Ishurdi"
            },
            {
                "id": 3,
                "name": "Bhangura"
            },
            {
                "id": 4,
                "name": "Pabnasadar"
            },
            {
                "id": 5,
                "name": "Bera"
            },
            {
                "id": 6,
                "name": "Atghoria"
            },
            {
                "id": 7,
                "name": "Chatmohar"
            },
            {
                "id": 8,
                "name": "Santhia"
            },
            {
                "id": 9,
                "name": "Faridpur"
            }
        ]
    },
    {
        "id": 50,
        "name": "Panchagarh",
        "upazilas": [
            {
                "id": 1,
                "name": "Panchagarhsadar"
            },
            {
                "id": 2,
                "name": "Debiganj"
            },
            {
                "id": 3,
                "name": "Boda"
            },
            {
                "id": 4,
                "name": "Atwari"
            },
            {
                "id": 5,
                "name": "Tetulia"
            }
        ]
    },
    {
        "id": 51,
        "name": "Patuakhali",
        "upazilas": [
            {
                "id": 1,
                "name": "Bauphal"
            },
            {
                "id": 2,
                "name": "Sadar"
            },
            {
                "id": 3,
                "name": "Dumki"
            },
            {
                "id": 4,
                "name": "Dashmina"
            },
            {
                "id": 5,
                "name": "Kalapara"
            },
            {
                "id": 6,
                "name": "Mirzaganj"
            },
            {
                "id": 7,
                "name": "Galachipa"
            },
            {
                "id": 8,
                "name": "Rangabali"
            }
        ]
    },
    {
        "id": 52,
        "name": "Pirojpur",
        "upazilas": [
            {
                "id": 1,
                "name": "Sadar"
            },
            {
                "id": 2,
                "name": "Nazirpur"
            },
            {
                "id": 3,
                "name": "Kawkhali"
            },
            {
                "id": 4,
                "name": "Bhandaria"
            },
            {
                "id": 5,
                "name": "Mathbaria"
            },
            {
                "id": 6,
                "name": "Nesarabad"
            },
            {
                "id": 7,
                "name": "Indurkani"
            }
        ]
    },
    {
        "id": 53,
        "name": "Rajbari",
        "upazilas": [
            {
                "id": 1,
                "name": "Sadar"
            },
            {
                "id": 2,
                "name": "Goalanda"
            },
            {
                "id": 3,
                "name": "Pangsa"
            },
            {
                "id": 4,
                "name": "Baliakandi"
            },
            {
                "id": 5,
                "name": "Kalukhali"
            }
        ]
    },
    {
        "id": 54,
        "name": "Rajshahi",
        "upazilas": [
            {
                "id": 1,
                "name": "Paba"
            },
            {
                "id": 2,
                "name": "Durgapur"
            },
            {
                "id": 3,
                "name": "Mohonpur"
            },
            {
                "id": 4,
                "name": "Charghat"
            },
            {
                "id": 5,
                "name": "Puthia"
            },
            {
                "id": 6,
                "name": "Bagha"
            },
            {
                "id": 7,
                "name": "Godagari"
            },
            {
                "id": 8,
                "name": "Tanore"
            },
            {
                "id": 9,
                "name": "Bagmara"
            }
        ]
    },
    {
        "id": 55,
        "name": "Rangamati",
        "upazilas": [
            {
                "id": 1,
                "name": "Sadar"
            },
            {
                "id": 2,
                "name": "Kaptai"
            },
            {
                "id": 3,
                "name": "Kawkhali"
            },
            {
                "id": 4,
                "name": "Baghaichari"
            },
            {
                "id": 5,
                "name": "Barkal"
            },
            {
                "id": 6,
                "name": "Langadu"
            },
            {
                "id": 7,
                "name": "Rajasthali"
            },
            {
                "id": 8,
                "name": "Belaichari"
            },
            {
                "id": 9,
                "name": "Juraichari"
            },
            {
                "id": 10,
                "name": "Naniarchar"
            }
        ]
    },
    {
        "id": 56,
        "name": "Rangpur",
        "upazilas": [
            {
                "id": 1,
                "name": "Rangpursadar"
            },
            {
                "id": 2,
                "name": "Gangachara"
            },
            {
                "id": 3,
                "name": "Taragonj"
            },
            {
                "id": 4,
                "name": "Badargonj"
            },
            {
                "id": 5,
                "name": "Mithapukur"
            },
            {
                "id": 6,
                "name": "Pirgonj"
            },
            {
                "id": 7,
                "name": "Kaunia"
            },
            {
                "id": 8,
                "name": "Pirgacha"
            }
        ]
    },
    {
        "id": 57,
        "name": "Satkhira",
        "upazilas": [
            {
                "id": 1,
                "name": "Assasuni"
            },
            {
                "id": 2,
                "name": "Debhata"
            },
            {
                "id": 3,
                "name": "Kalaroa"
            },
            {
                "id": 4,
                "name": "Satkhirasadar"
            },
            {
                "id": 5,
                "name": "Shyamnagar"
            },
            {
                "id": 6,
                "name": "Tala"
            },
            {
                "id": 7,
                "name": "Kaliganj"
            }
        ]
    },
    {
        "id": 58,
        "name": "Shariatpur",
        "upazilas": [
            {
                "id": 1,
                "name": "Sadar"
            },
            {
                "id": 2,
                "name": "Naria"
            },
            {
                "id": 3,
                "name": "Zajira"
            },
            {
                "id": 4,
                "name": "Gosairhat"
            },
            {
                "id": 5,
                "name": "Bhedarganj"
            },
            {
                "id": 6,
                "name": "Damudya"
            }
        ]
    },
    {
        "id": 59,
        "name": "Sherpur",
        "upazilas": [
            {
                "id": 1,
                "name": "Sherpursadar"
            },
            {
                "id": 2,
                "name": "Nalitabari"
            },
            {
                "id": 3,
                "name": "Sreebordi"
            },
            {
                "id": 4,
                "name": "Nokla"
            },
            {
                "id": 5,
                "name": "Jhenaigati"
            }
        ]
    },
    {
        "id": 60,
        "name": "Sirajganj",
        "upazilas": [
            {
                "id": 1,
                "name": "Belkuchi"
            },
            {
                "id": 2,
                "name": "Chauhali"
            },
            {
                "id": 3,
                "name": "Kamarkhand"
            },
            {
                "id": 4,
                "name": "Kazipur"
            },
            {
                "id": 5,
                "name": "Raigonj"
            },
            {
                "id": 6,
                "name": "Shahjadpur"
            },
            {
                "id": 7,
                "name": "Sirajganjsadar"
            },
            {
                "id": 8,
                "name": "Tarash"
            },
            {
                "id": 9,
                "name": "Ullapara"
            }
        ]
    },
    {
        "id": 61,
        "name": "Sunamganj",
        "upazilas": [
            {
                "id": 1,
                "name": "Sadar"
            },
            {
                "id": 2,
                "name": "Southsunamganj"
            },
            {
                "id": 3,
                "name": "Bishwambarpur"
            },
            {
                "id": 4,
                "name": "Chhatak"
            },
            {
                "id": 5,
                "name": "Jagannathpur"
            },
            {
                "id": 6,
                "name": "Dowarabazar"
            },
            {
                "id": 7,
                "name": "Tahirpur"
            },
            {
                "id": 8,
                "name": "Dharmapasha"
            },
            {
                "id": 9,
                "name": "Jamalganj"
            },
            {
                "id": 10,
                "name": "Shalla"
            },
            {
                "id": 11,
                "name": "Derai"
            },
            {
                "id": 12,
                "name": "Madhyanagar"
            }
        ]
    },
    {
        "id": 62,
        "name": "Sylhet",
        "upazilas": [
            {
                "id": 1,
                "name": "Balaganj"
            },
            {
                "id": 2,
                "name": "Beanibazar"
            },
            {
                "id": 3,
                "name": "Bishwanath"
            },
            {
                "id": 4,
                "name": "Companiganj"
            },
            {
                "id": 5,
                "name": "Fenchuganj"
            },
            {
                "id": 6,
                "name": "Golapganj"
            },
            {
                "id": 7,
                "name": "Gowainghat"
            },
            {
                "id": 8,
                "name": "Jaintiapur"
            },
            {
                "id": 9,
                "name": "Kanaighat"
            },
            {
                "id": 10,
                "name": "Sylhetsadar"
            },
            {
                "id": 11,
                "name": "Zakiganj"
            },
            {
                "id": 12,
                "name": "Dakshinsurma"
            },
            {
                "id": 13,
                "name": "Osmaninagar"
            }
        ]
    },
    {
        "id": 63,
        "name": "Tangail",
        "upazilas": [
            {
                "id": 1,
                "name": "Basail"
            },
            {
                "id": 2,
                "name": "Bhuapur"
            },
            {
                "id": 3,
                "name": "Delduar"
            },
            {
                "id": 4,
                "name": "Ghatail"
            },
            {
                "id": 5,
                "name": "Gopalpur"
            },
            {
                "id": 6,
                "name": "Madhupur"
            },
            {
                "id": 7,
                "name": "Mirzapur"
            },
            {
                "id": 8,
                "name": "Nagarpur"
            },
            {
                "id": 9,
                "name": "Sakhipur"
            },
            {
                "id": 10,
                "name": "Tangailsadar"
            },
            {
                "id": 11,
                "name": "Kalihati"
            },
            {
                "id": 12,
                "name": "Dhanbari"
            }
        ]
    },
    {
        "id": 64,
        "name": "Thakurgaon",
        "upazilas": [
            {
                "id": 1,
                "name": "Thakurgaonsadar"
            },
            {
                "id": 2,
                "name": "Pirganj"
            },
            {
                "id": 3,
                "name": "Ranisankail"
            },
            {
                "id": 4,
                "name": "Haripur"
            },
            {
                "id": 5,
                "name": "Baliadangi"
            }
        ]
    }
]

const upazilasEn = ref(null);


const districtsBn = [
    {
        "id": 1,
        "name": "বাগেরহাট",
        "upazilas": [
            {
                "id": 1,
                "name": "ফকিরহাট"
            },
            {
                "id": 2,
                "name": "বাগেরহাট সদর"
            },
            {
                "id": 3,
                "name": "মোল্লাহাট"
            },
            {
                "id": 4,
                "name": "শরণখোলা"
            },
            {
                "id": 5,
                "name": "রামপাল"
            },
            {
                "id": 6,
                "name": "মোড়েলগঞ্জ"
            },
            {
                "id": 7,
                "name": "কচুয়া"
            },
            {
                "id": 8,
                "name": "মোংলা"
            },
            {
                "id": 9,
                "name": "চিতলমারী"
            }
        ]
    },
    {
        "id": 2,
        "name": "বান্দরবান",
        "upazilas": [
            {
                "id": 1,
                "name": "বান্দরবান সদর"
            },
            {
                "id": 2,
                "name": "আলীকদম"
            },
            {
                "id": 3,
                "name": "নাইক্ষ্যংছড়ি"
            },
            {
                "id": 4,
                "name": "রোয়াংছড়ি"
            },
            {
                "id": 5,
                "name": "লামা"
            },
            {
                "id": 6,
                "name": "রুমা"
            },
            {
                "id": 7,
                "name": "থানচি"
            }
        ]
    },
    {
        "id": 3,
        "name": "বরগুনা",
        "upazilas": [
            {
                "id": 1,
                "name": "আমতলী"
            },
            {
                "id": 2,
                "name": "বরগুনা সদর"
            },
            {
                "id": 3,
                "name": "বেতাগী"
            },
            {
                "id": 4,
                "name": "বামনা"
            },
            {
                "id": 5,
                "name": "পাথরঘাটা"
            },
            {
                "id": 6,
                "name": "তালতলি"
            }
        ]
    },
    {
        "id": 4,
        "name": "বরিশাল",
        "upazilas": [
            {
                "id": 1,
                "name": "বরিশাল সদর"
            },
            {
                "id": 2,
                "name": "বাকেরগঞ্জ"
            },
            {
                "id": 3,
                "name": "বাবুগঞ্জ"
            },
            {
                "id": 4,
                "name": "উজিরপুর"
            },
            {
                "id": 5,
                "name": "বানারীপাড়া"
            },
            {
                "id": 6,
                "name": "গৌরনদী"
            },
            {
                "id": 7,
                "name": "আগৈলঝাড়া"
            },
            {
                "id": 8,
                "name": "মেহেন্দিগঞ্জ"
            },
            {
                "id": 9,
                "name": "মুলাদী"
            },
            {
                "id": 10,
                "name": "হিজলা"
            }
        ]
    },
    {
        "id": 5,
        "name": "ভোলা",
        "upazilas": [
            {
                "id": 1,
                "name": "ভোলা সদর"
            },
            {
                "id": 2,
                "name": "বোরহান উদ্দিন"
            },
            {
                "id": 3,
                "name": "চরফ্যাশন"
            },
            {
                "id": 4,
                "name": "দৌলতখান"
            },
            {
                "id": 5,
                "name": "মনপুরা"
            },
            {
                "id": 6,
                "name": "তজুমদ্দিন"
            },
            {
                "id": 7,
                "name": "লালমোহন"
            }
        ]
    },
    {
        "id": 6,
        "name": "বগুড়া",
        "upazilas": [
            {
                "id": 1,
                "name": "কাহালু"
            },
            {
                "id": 2,
                "name": "বগুড়া সদর"
            },
            {
                "id": 3,
                "name": "সারিয়াকান্দি"
            },
            {
                "id": 4,
                "name": "শাজাহানপুর"
            },
            {
                "id": 5,
                "name": "দুপচাচিঁয়া"
            },
            {
                "id": 6,
                "name": "আদমদিঘি"
            },
            {
                "id": 7,
                "name": "নন্দিগ্রাম"
            },
            {
                "id": 8,
                "name": "সোনাতলা"
            },
            {
                "id": 9,
                "name": "ধুনট"
            },
            {
                "id": 10,
                "name": "গাবতলী"
            },
            {
                "id": 11,
                "name": "শেরপুর"
            },
            {
                "id": 12,
                "name": "শিবগঞ্জ"
            }
        ]
    },
    {
        "id": 7,
        "name": "ব্রাহ্মণবাড়িয়া",
        "upazilas": [
            {
                "id": 1,
                "name": "ব্রাহ্মণবাড়িয়া সদর"
            },
            {
                "id": 2,
                "name": "কসবা"
            },
            {
                "id": 3,
                "name": "নাসিরনগর"
            },
            {
                "id": 4,
                "name": "সরাইল"
            },
            {
                "id": 5,
                "name": "আশুগঞ্জ"
            },
            {
                "id": 6,
                "name": "আখাউড়া"
            },
            {
                "id": 7,
                "name": "নবীনগর"
            },
            {
                "id": 8,
                "name": "বাঞ্ছারামপুর"
            },
            {
                "id": 9,
                "name": "বিজয়নগর"
            }
        ]
    },
    {
        "id": 8,
        "name": "চাঁদপুর",
        "upazilas": [
            {
                "id": 1,
                "name": "হাইমচর"
            },
            {
                "id": 2,
                "name": "কচুয়া"
            },
            {
                "id": 3,
                "name": "শাহরাস্তি"
            },
            {
                "id": 4,
                "name": "চাঁদপুর সদর"
            },
            {
                "id": 5,
                "name": "মতলব"
            },
            {
                "id": 6,
                "name": "হাজীগঞ্জ"
            },
            {
                "id": 7,
                "name": "মতলব"
            },
            {
                "id": 8,
                "name": "ফরিদগঞ্জ"
            }
        ]
    },
    {
        "id": 9,
        "name": "চাঁপাইনবাবগঞ্জ",
        "upazilas": [
            {
                "id": 1,
                "name": "চাঁপাইনবাবগঞ্জ সদর"
            },
            {
                "id": 2,
                "name": "গোমস্তাপুর"
            },
            {
                "id": 3,
                "name": "নাচোল"
            },
            {
                "id": 4,
                "name": "ভোলাহাট"
            },
            {
                "id": 5,
                "name": "শিবগঞ্জ"
            }
        ]
    },
    {
        "id": 10,
        "name": "চট্টগ্রাম",
        "upazilas": [
            {
                "id": 1,
                "name": "রাঙ্গুনিয়া"
            },
            {
                "id": 2,
                "name": "সীতাকুন্ড"
            },
            {
                "id": 3,
                "name": "মীরসরাই"
            },
            {
                "id": 4,
                "name": "পটিয়া"
            },
            {
                "id": 5,
                "name": "সন্দ্বীপ"
            },
            {
                "id": 6,
                "name": "বাঁশখালী"
            },
            {
                "id": 7,
                "name": "বোয়ালখালী"
            },
            {
                "id": 8,
                "name": "আনোয়ারা"
            },
            {
                "id": 9,
                "name": "চন্দনাইশ"
            },
            {
                "id": 10,
                "name": "সাতকানিয়া"
            },
            {
                "id": 11,
                "name": "লোহাগাড়া"
            },
            {
                "id": 12,
                "name": "হাটহাজারী"
            },
            {
                "id": 13,
                "name": "ফটিকছড়ি"
            },
            {
                "id": 14,
                "name": "রাউজান"
            },
            {
                "id": 15,
                "name": "কর্ণফুলী"
            }
        ]
    },
    {
        "id": 11,
        "name": "চুয়াডাঙ্গা",
        "upazilas": [
            {
                "id": 1,
                "name": "চুয়াডাঙ্গা সদর"
            },
            {
                "id": 2,
                "name": "আলমডাঙ্গা"
            },
            {
                "id": 3,
                "name": "দামুড়হুদা"
            },
            {
                "id": 4,
                "name": "জীবননগর"
            }
        ]
    },
    {
        "id": 12,
        "name": "কক্সবাজার",
        "upazilas": [
            {
                "id": 1,
                "name": "কক্সবাজার সদর"
            },
            {
                "id": 2,
                "name": "চকরিয়া"
            },
            {
                "id": 3,
                "name": "কুতুবদিয়া"
            },
            {
                "id": 4,
                "name": "উখিয়া"
            },
            {
                "id": 5,
                "name": "মহেশখালী"
            },
            {
                "id": 6,
                "name": "পেকুয়া"
            },
            {
                "id": 7,
                "name": "রামু"
            },
            {
                "id": 8,
                "name": "টেকনাফ"
            }
        ]
    },
    {
        "id": 13,
        "name": "কুমিল্লা",
        "upazilas": [
            {
                "id": 1,
                "name": "দেবিদ্বার"
            },
            {
                "id": 2,
                "name": "বরুড়া"
            },
            {
                "id": 3,
                "name": "ব্রাহ্মণপাড়া"
            },
            {
                "id": 4,
                "name": "চান্দিনা"
            },
            {
                "id": 5,
                "name": "চৌদ্দগ্রাম"
            },
            {
                "id": 6,
                "name": "দাউদকান্দি"
            },
            {
                "id": 7,
                "name": "হোমনা"
            },
            {
                "id": 8,
                "name": "লাকসাম"
            },
            {
                "id": 9,
                "name": "মুরাদনগর"
            },
            {
                "id": 10,
                "name": "নাঙ্গলকোট"
            },
            {
                "id": 11,
                "name": "কুমিল্লা সদর"
            },
            {
                "id": 12,
                "name": "মেঘনা"
            },
            {
                "id": 13,
                "name": "মনোহরগঞ্জ"
            },
            {
                "id": 14,
                "name": "সদর দক্ষিণ"
            },
            {
                "id": 15,
                "name": "তিতাস"
            },
            {
                "id": 16,
                "name": "বুড়িচং"
            },
            {
                "id": 17,
                "name": "লালমাই"
            }
        ]
    },
    {
        "id": 14,
        "name": "ঢাকা",
        "upazilas": [
            {
                "id": 1,
                "name": "সাভার"
            },
            {
                "id": 2,
                "name": "ধামরাই"
            },
            {
                "id": 3,
                "name": "কেরাণীগঞ্জ"
            },
            {
                "id": 4,
                "name": "নবাবগঞ্জ"
            },
            {
                "id": 5,
                "name": "দোহার"
            }
        ]
    },
    {
        "id": 15,
        "name": "দিনাজপুর",
        "upazilas": [
            {
                "id": 1,
                "name": "নবাবগঞ্জ"
            },
            {
                "id": 2,
                "name": "বীরগঞ্জ"
            },
            {
                "id": 3,
                "name": "ঘোড়াঘাট"
            },
            {
                "id": 4,
                "name": "বিরামপুর"
            },
            {
                "id": 5,
                "name": "পার্বতীপুর"
            },
            {
                "id": 6,
                "name": "বোচাগঞ্জ"
            },
            {
                "id": 7,
                "name": "কাহারোল"
            },
            {
                "id": 8,
                "name": "ফুলবাড়ী"
            },
            {
                "id": 9,
                "name": "দিনাজপুর সদর"
            },
            {
                "id": 10,
                "name": "হাকিমপুর"
            },
            {
                "id": 11,
                "name": "খানসামা"
            },
            {
                "id": 12,
                "name": "বিরল"
            },
            {
                "id": 13,
                "name": "চিরিরবন্দর"
            }
        ]
    },
    {
        "id": 16,
        "name": "ফরিদপুর",
        "upazilas": [
            {
                "id": 1,
                "name": "ফরিদপুর সদর"
            },
            {
                "id": 2,
                "name": "আলফাডাঙ্গা"
            },
            {
                "id": 3,
                "name": "বোয়ালমারী"
            },
            {
                "id": 4,
                "name": "সদরপুর"
            },
            {
                "id": 5,
                "name": "নগরকান্দা"
            },
            {
                "id": 6,
                "name": "ভাঙ্গা"
            },
            {
                "id": 7,
                "name": "চরভদ্রাসন"
            },
            {
                "id": 8,
                "name": "মধুখালী"
            },
            {
                "id": 9,
                "name": "সালথা"
            }
        ]
    },
    {
        "id": 17,
        "name": "ফেনী",
        "upazilas": [
            {
                "id": 1,
                "name": "ছাগলনাইয়া"
            },
            {
                "id": 2,
                "name": "ফেনী সদর"
            },
            {
                "id": 3,
                "name": "সোনাগাজী"
            },
            {
                "id": 4,
                "name": "ফুলগাজী"
            },
            {
                "id": 5,
                "name": "পরশুরাম"
            },
            {
                "id": 6,
                "name": "দাগনভূঞা"
            }
        ]
    },
    {
        "id": 18,
        "name": "গাইবান্ধা",
        "upazilas": [
            {
                "id": 1,
                "name": "সাদুল্লাপুর"
            },
            {
                "id": 2,
                "name": "গাইবান্ধা সদর"
            },
            {
                "id": 3,
                "name": "পলাশবাড়ী"
            },
            {
                "id": 4,
                "name": "সাঘাটা"
            },
            {
                "id": 5,
                "name": "গোবিন্দগঞ্জ"
            },
            {
                "id": 6,
                "name": "সুন্দরগঞ্জ"
            },
            {
                "id": 7,
                "name": "ফুলছড়ি"
            }
        ]
    },
    {
        "id": 19,
        "name": "গাজীপুর",
        "upazilas": [
            {
                "id": 1,
                "name": "কালীগঞ্জ"
            },
            {
                "id": 2,
                "name": "কালিয়াকৈর"
            },
            {
                "id": 3,
                "name": "কাপাসিয়া"
            },
            {
                "id": 4,
                "name": "গাজীপুর সদর"
            },
            {
                "id": 5,
                "name": "শ্রীপুর"
            }
        ]
    },
    {
        "id": 20,
        "name": "গোপালগঞ্জ",
        "upazilas": [
            {
                "id": 1,
                "name": "গোপালগঞ্জ সদর"
            },
            {
                "id": 2,
                "name": "কাশিয়ানী"
            },
            {
                "id": 3,
                "name": "টুংগীপাড়া"
            },
            {
                "id": 4,
                "name": "কোটালীপাড়া"
            },
            {
                "id": 5,
                "name": "মুকসুদপুর"
            }
        ]
    },
    {
        "id": 21,
        "name": "হবিগঞ্জ",
        "upazilas": [
            {
                "id": 1,
                "name": "নবীগঞ্জ"
            },
            {
                "id": 2,
                "name": "বাহুবল"
            },
            {
                "id": 3,
                "name": "আজমিরীগঞ্জ"
            },
            {
                "id": 4,
                "name": "বানিয়াচং"
            },
            {
                "id": 5,
                "name": "লাখাই"
            },
            {
                "id": 6,
                "name": "চুনারুঘাট"
            },
            {
                "id": 7,
                "name": "হবিগঞ্জ সদর"
            },
            {
                "id": 8,
                "name": "মাধবপুর"
            },
            {
                "id": 9,
                "name": "শায়েস্তাগঞ্জ"
            }
        ]
    },
    {
        "id": 22,
        "name": "জামালপুর",
        "upazilas": [
            {
                "id": 1,
                "name": "জামালপুর সদর"
            },
            {
                "id": 2,
                "name": "মেলান্দহ"
            },
            {
                "id": 3,
                "name": "ইসলামপুর"
            },
            {
                "id": 4,
                "name": "দেওয়ানগঞ্জ"
            },
            {
                "id": 5,
                "name": "সরিষাবাড়ী"
            },
            {
                "id": 6,
                "name": "মাদারগঞ্জ"
            },
            {
                "id": 7,
                "name": "বকশীগঞ্জ"
            }
        ]
    },
    {
        "id": 23,
        "name": "যশোর",
        "upazilas": [
            {
                "id": 1,
                "name": "মণিরামপুর"
            },
            {
                "id": 2,
                "name": "অভয়নগর"
            },
            {
                "id": 3,
                "name": "বাঘারপাড়া"
            },
            {
                "id": 4,
                "name": "চৌগাছা"
            },
            {
                "id": 5,
                "name": "ঝিকরগাছা"
            },
            {
                "id": 6,
                "name": "কেশবপুর"
            },
            {
                "id": 7,
                "name": "যশোর সদর"
            },
            {
                "id": 8,
                "name": "শার্শা"
            }
        ]
    },
    {
        "id": 24,
        "name": "ঝালকাঠি",
        "upazilas": [
            {
                "id": 1,
                "name": "ঝালকাঠি সদর"
            },
            {
                "id": 2,
                "name": "কাঠালিয়া"
            },
            {
                "id": 3,
                "name": "নলছিটি"
            },
            {
                "id": 4,
                "name": "রাজাপুর"
            }
        ]
    },
    {
        "id": 25,
        "name": "ঝিনাইদহ",
        "upazilas": [
            {
                "id": 1,
                "name": "ঝিনাইদহ সদর"
            },
            {
                "id": 2,
                "name": "শৈলকুপা"
            },
            {
                "id": 3,
                "name": "হরিণাকুন্ডু"
            },
            {
                "id": 4,
                "name": "কালীগঞ্জ"
            },
            {
                "id": 5,
                "name": "কোটচাঁদপুর"
            },
            {
                "id": 6,
                "name": "মহেশপুর"
            }
        ]
    },
    {
        "id": 26,
        "name": "জয়পুরহাট",
        "upazilas": [
            {
                "id": 1,
                "name": "আক্কেলপুর"
            },
            {
                "id": 2,
                "name": "কালাই"
            },
            {
                "id": 3,
                "name": "ক্ষেতলাল"
            },
            {
                "id": 4,
                "name": "পাঁচবিবি"
            },
            {
                "id": 5,
                "name": "জয়পুরহাট সদর"
            }
        ]
    },
    {
        "id": 27,
        "name": "খাগড়াছড়ি",
        "upazilas": [
            {
                "id": 1,
                "name": "খাগড়াছড়ি সদর"
            },
            {
                "id": 2,
                "name": "দিঘীনালা"
            },
            {
                "id": 3,
                "name": "পানছড়ি"
            },
            {
                "id": 4,
                "name": "লক্ষীছড়ি"
            },
            {
                "id": 5,
                "name": "মহালছড়ি"
            },
            {
                "id": 6,
                "name": "মানিকছড়ি"
            },
            {
                "id": 7,
                "name": "রামগড়"
            },
            {
                "id": 8,
                "name": "মাটিরাঙ্গা"
            },
            {
                "id": 9,
                "name": "গুইমারা"
            }
        ]
    },
    {
        "id": 28,
        "name": "খুলনা",
        "upazilas": [
            {
                "id": 1,
                "name": "পাইকগাছা"
            },
            {
                "id": 2,
                "name": "ফুলতলা"
            },
            {
                "id": 3,
                "name": "দিঘলিয়া"
            },
            {
                "id": 4,
                "name": "রূপসা"
            },
            {
                "id": 5,
                "name": "তেরখাদা"
            },
            {
                "id": 6,
                "name": "ডুমুরিয়া"
            },
            {
                "id": 7,
                "name": "বটিয়াঘাটা"
            },
            {
                "id": 8,
                "name": "দাকোপ"
            },
            {
                "id": 9,
                "name": "কয়রা"
            }
        ]
    },
    {
        "id": 29,
        "name": "কিশোরগঞ্জ",
        "upazilas": [
            {
                "id": 1,
                "name": "ইটনা"
            },
            {
                "id": 2,
                "name": "কটিয়াদী"
            },
            {
                "id": 3,
                "name": "ভৈরব"
            },
            {
                "id": 4,
                "name": "তাড়াইল"
            },
            {
                "id": 5,
                "name": "হোসেনপুর"
            },
            {
                "id": 6,
                "name": "পাকুন্দিয়া"
            },
            {
                "id": 7,
                "name": "কুলিয়ারচর"
            },
            {
                "id": 8,
                "name": "কিশোরগঞ্জ সদর"
            },
            {
                "id": 9,
                "name": "করিমগঞ্জ"
            },
            {
                "id": 10,
                "name": "বাজিতপুর"
            },
            {
                "id": 11,
                "name": "অষ্টগ্রাম"
            },
            {
                "id": 12,
                "name": "মিঠামইন"
            },
            {
                "id": 13,
                "name": "নিকলী"
            }
        ]
    },
    {
        "id": 30,
        "name": "কুড়িগ্রাম",
        "upazilas": [
            {
                "id": 1,
                "name": "কুড়িগ্রাম সদর"
            },
            {
                "id": 2,
                "name": "নাগেশ্বরী"
            },
            {
                "id": 3,
                "name": "ভুরুঙ্গামারী"
            },
            {
                "id": 4,
                "name": "ফুলবাড়ী"
            },
            {
                "id": 5,
                "name": "রাজারহাট"
            },
            {
                "id": 6,
                "name": "উলিপুর"
            },
            {
                "id": 7,
                "name": "চিলমারী"
            },
            {
                "id": 8,
                "name": "রৌমারী"
            },
            {
                "id": 9,
                "name": "চর রাজিবপুর"
            }
        ]
    },
    {
        "id": 31,
        "name": "কুষ্টিয়া",
        "upazilas": [
            {
                "id": 1,
                "name": "কুষ্টিয়া সদর"
            },
            {
                "id": 2,
                "name": "কুমারখালী"
            },
            {
                "id": 3,
                "name": "খোকসা"
            },
            {
                "id": 4,
                "name": "মিরপুর"
            },
            {
                "id": 5,
                "name": "দৌলতপুর"
            },
            {
                "id": 6,
                "name": "ভেড়ামারা"
            }
        ]
    },
    {
        "id": 32,
        "name": "লক্ষ্মীপুর",
        "upazilas": [
            {
                "id": 1,
                "name": "লক্ষ্মীপুর সদর"
            },
            {
                "id": 2,
                "name": "কমলনগর"
            },
            {
                "id": 3,
                "name": "রায়পুর"
            },
            {
                "id": 4,
                "name": "রামগতি"
            },
            {
                "id": 5,
                "name": "রামগঞ্জ"
            }
        ]
    },
    {
        "id": 33,
        "name": "লালমনিরহাট",
        "upazilas": [
            {
                "id": 1,
                "name": "লালমনিরহাট সদর"
            },
            {
                "id": 2,
                "name": "কালীগঞ্জ"
            },
            {
                "id": 3,
                "name": "হাতীবান্ধা"
            },
            {
                "id": 4,
                "name": "পাটগ্রাম"
            },
            {
                "id": 5,
                "name": "আদিতমারী"
            }
        ]
    },
    {
        "id": 34,
        "name": "মাদারীপুর",
        "upazilas": [
            {
                "id": 1,
                "name": "মাদারীপুর সদর"
            },
            {
                "id": 2,
                "name": "শিবচর"
            },
            {
                "id": 3,
                "name": "কালকিনি"
            },
            {
                "id": 4,
                "name": "রাজৈর"
            },
            {
                "id": 5,
                "name": "ডাসার"
            }
        ]
    },
    {
        "id": 35,
        "name": "মাগুরা",
        "upazilas": [
            {
                "id": 1,
                "name": "শালিখা"
            },
            {
                "id": 2,
                "name": "শ্রীপুর"
            },
            {
                "id": 3,
                "name": "মাগুরা সদর"
            },
            {
                "id": 4,
                "name": "মহম্মদপুর"
            }
        ]
    },
    {
        "id": 36,
        "name": "মানিকগঞ্জ",
        "upazilas": [
            {
                "id": 1,
                "name": "হরিরামপুর"
            },
            {
                "id": 2,
                "name": "সাটুরিয়া"
            },
            {
                "id": 3,
                "name": "মানিকগঞ্জ সদর"
            },
            {
                "id": 4,
                "name": "ঘিওর"
            },
            {
                "id": 5,
                "name": "শিবালয়"
            },
            {
                "id": 6,
                "name": "দৌলতপুর"
            },
            {
                "id": 7,
                "name": "সিংগাইর"
            }
        ]
    },
    {
        "id": 37,
        "name": "মেহেরপুর",
        "upazilas": [
            {
                "id": 1,
                "name": "মুজিবনগর"
            },
            {
                "id": 2,
                "name": "মেহেরপুর সদর"
            },
            {
                "id": 3,
                "name": "গাংনী"
            }
        ]
    },
    {
        "id": 38,
        "name": "মৌলভীবাজার",
        "upazilas": [
            {
                "id": 1,
                "name": "বড়লেখা"
            },
            {
                "id": 2,
                "name": "কমলগঞ্জ"
            },
            {
                "id": 3,
                "name": "কুলাউড়া"
            },
            {
                "id": 4,
                "name": "মৌলভীবাজার সদর"
            },
            {
                "id": 5,
                "name": "রাজনগর"
            },
            {
                "id": 6,
                "name": "শ্রীমঙ্গল"
            },
            {
                "id": 7,
                "name": "জুড়ী"
            }
        ]
    },
    {
        "id": 39,
        "name": "মুন্সিগঞ্জ",
        "upazilas": [
            {
                "id": 1,
                "name": "মুন্সিগঞ্জ সদর"
            },
            {
                "id": 2,
                "name": "শ্রীনগর"
            },
            {
                "id": 3,
                "name": "সিরাজদিখান"
            },
            {
                "id": 4,
                "name": "লৌহজং"
            },
            {
                "id": 5,
                "name": "গজারিয়া"
            },
            {
                "id": 6,
                "name": "টংগীবাড়ি"
            }
        ]
    },
    {
        "id": 40,
        "name": "ময়মনসিংহ",
        "upazilas": [
            {
                "id": 1,
                "name": "ফুলবাড়ীয়া"
            },
            {
                "id": 2,
                "name": "ত্রিশাল"
            },
            {
                "id": 3,
                "name": "ভালুকা"
            },
            {
                "id": 4,
                "name": "মুক্তাগাছা"
            },
            {
                "id": 5,
                "name": "ময়মনসিংহ সদর"
            },
            {
                "id": 6,
                "name": "ধোবাউড়া"
            },
            {
                "id": 7,
                "name": "ফুলপুর"
            },
            {
                "id": 8,
                "name": "হালুয়াঘাট"
            },
            {
                "id": 9,
                "name": "গৌরীপুর"
            },
            {
                "id": 10,
                "name": "গফরগাঁও"
            },
            {
                "id": 11,
                "name": "ঈশ্বরগঞ্জ"
            },
            {
                "id": 12,
                "name": "নান্দাইল"
            },
            {
                "id": 13,
                "name": "তারাকান্দা"
            }
        ]
    },
    {
        "id": 41,
        "name": "নওগাঁ",
        "upazilas": [
            {
                "id": 1,
                "name": "মহাদেবপুর"
            },
            {
                "id": 2,
                "name": "বদলগাছী"
            },
            {
                "id": 3,
                "name": "পত্নিতলা"
            },
            {
                "id": 4,
                "name": "ধামইরহাট"
            },
            {
                "id": 5,
                "name": "নিয়ামতপুর"
            },
            {
                "id": 6,
                "name": "মান্দা"
            },
            {
                "id": 7,
                "name": "আত্রাই"
            },
            {
                "id": 8,
                "name": "রাণীনগর"
            },
            {
                "id": 9,
                "name": "নওগাঁ সদর"
            },
            {
                "id": 10,
                "name": "পোরশা"
            },
            {
                "id": 11,
                "name": "সাপাহার"
            }
        ]
    },
    {
        "id": 42,
        "name": "নড়াইল",
        "upazilas": [
            {
                "id": 1,
                "name": "নড়াইল সদর"
            },
            {
                "id": 2,
                "name": "লোহাগড়া"
            },
            {
                "id": 3,
                "name": "কালিয়া"
            }
        ]
    },
    {
        "id": 43,
        "name": "নারায়নগঞ্জ",
        "upazilas": [
            {
                "id": 1,
                "name": "আড়াইহাজার"
            },
            {
                "id": 2,
                "name": "বন্দর"
            },
            {
                "id": 3,
                "name": "নারায়নগঞ্জ সদর"
            },
            {
                "id": 4,
                "name": "রূপগঞ্জ"
            },
            {
                "id": 5,
                "name": "সোনারগাঁ"
            }
        ]
    },
    {
        "id": 44,
        "name": "নরসিংদী",
        "upazilas": [
            {
                "id": 1,
                "name": "বেলাবো"
            },
            {
                "id": 2,
                "name": "মনোহরদী"
            },
            {
                "id": 3,
                "name": "নরসিংদী"
            },
            {
                "id": 4,
                "name": "পলাশ"
            },
            {
                "id": 5,
                "name": "রায়পুরা"
            },
            {
                "id": 6,
                "name": "শিবপুর"
            }
        ]
    },
    {
        "id": 45,
        "name": "নাটোর",
        "upazilas": [
            {
                "id": 1,
                "name": "নাটোর সদর"
            },
            {
                "id": 2,
                "name": "সিংড়া"
            },
            {
                "id": 3,
                "name": "বড়াইগ্রাম"
            },
            {
                "id": 4,
                "name": "বাগাতিপাড়া"
            },
            {
                "id": 5,
                "name": "লালপুর"
            },
            {
                "id": 6,
                "name": "গুরুদাসপুর"
            },
            {
                "id": 7,
                "name": "নলডাঙ্গা"
            }
        ]
    },
    {
        "id": 46,
        "name": "নেত্রকোণা",
        "upazilas": [
            {
                "id": 1,
                "name": "বারহাট্টা"
            },
            {
                "id": 2,
                "name": "দুর্গাপুর"
            },
            {
                "id": 3,
                "name": "কেন্দুয়া"
            },
            {
                "id": 4,
                "name": "আটপাড়া"
            },
            {
                "id": 5,
                "name": "মদন"
            },
            {
                "id": 6,
                "name": "খালিয়াজুরী"
            },
            {
                "id": 7,
                "name": "কলমাকান্দা"
            },
            {
                "id": 8,
                "name": "মোহনগঞ্জ"
            },
            {
                "id": 9,
                "name": "পূর্বধলা"
            },
            {
                "id": 10,
                "name": "নেত্রকোণা সদর"
            }
        ]
    },
    {
        "id": 47,
        "name": "নীলফামারী",
        "upazilas": [
            {
                "id": 1,
                "name": "সৈয়দপুর"
            },
            {
                "id": 2,
                "name": "ডোমার"
            },
            {
                "id": 3,
                "name": "ডিমলা"
            },
            {
                "id": 4,
                "name": "জলঢাকা"
            },
            {
                "id": 5,
                "name": "কিশোরগঞ্জ"
            },
            {
                "id": 6,
                "name": "নীলফামারী সদর"
            }
        ]
    },
    {
        "id": 48,
        "name": "নোয়াখালী",
        "upazilas": [
            {
                "id": 1,
                "name": "নোয়াখালী"
            },
            {
                "id": 2,
                "name": "কোম্পানীগঞ্জ"
            },
            {
                "id": 3,
                "name": "বেগমগঞ্জ"
            },
            {
                "id": 4,
                "name": "হাতিয়া"
            },
            {
                "id": 5,
                "name": "সুবর্ণচর"
            },
            {
                "id": 6,
                "name": "কবিরহাট"
            },
            {
                "id": 7,
                "name": "সেনবাগ"
            },
            {
                "id": 8,
                "name": "চাটখিল"
            },
            {
                "id": 9,
                "name": "সোনাইমুড়ী"
            }
        ]
    },
    {
        "id": 49,
        "name": "পাবনা",
        "upazilas": [
            {
                "id": 1,
                "name": "সুজানগর"
            },
            {
                "id": 2,
                "name": "ঈশ্বরদী"
            },
            {
                "id": 3,
                "name": "ভাঙ্গুড়া"
            },
            {
                "id": 4,
                "name": "পাবনা সদর"
            },
            {
                "id": 5,
                "name": "বেড়া"
            },
            {
                "id": 6,
                "name": "আটঘরিয়া"
            },
            {
                "id": 7,
                "name": "চাটমোহর"
            },
            {
                "id": 8,
                "name": "সাঁথিয়া"
            },
            {
                "id": 9,
                "name": "ফরিদপুর"
            }
        ]
    },
    {
        "id": 50,
        "name": "পঞ্চগড়",
        "upazilas": [
            {
                "id": 1,
                "name": "পঞ্চগড়"
            },
            {
                "id": 2,
                "name": "দেবীগঞ্জ"
            },
            {
                "id": 3,
                "name": "বোদা"
            },
            {
                "id": 4,
                "name": "আটোয়ারী"
            },
            {
                "id": 5,
                "name": "তেতুলিয়া"
            }
        ]
    },
    {
        "id": 51,
        "name": "পটুয়াখালী",
        "upazilas": [
            {
                "id": 1,
                "name": "বাউফল"
            },
            {
                "id": 2,
                "name": "পটুয়াখালী সদর"
            },
            {
                "id": 3,
                "name": "দুমকি"
            },
            {
                "id": 4,
                "name": "দশমিনা"
            },
            {
                "id": 5,
                "name": "কলাপাড়া"
            },
            {
                "id": 6,
                "name": "মির্জাগঞ্জ"
            },
            {
                "id": 7,
                "name": "গলাচিপা"
            },
            {
                "id": 8,
                "name": "রাঙ্গাবালী"
            }
        ]
    },
    {
        "id": 52,
        "name": "পিরোজপুর",
        "upazilas": [
            {
                "id": 1,
                "name": "পিরোজপুর সদর"
            },
            {
                "id": 2,
                "name": "নাজিরপুর"
            },
            {
                "id": 3,
                "name": "কাউখালী"
            },
            {
                "id": 4,
                "name": "ভান্ডারিয়া"
            },
            {
                "id": 5,
                "name": "মঠবাড়ীয়া"
            },
            {
                "id": 6,
                "name": "নেছারাবাদ"
            },
            {
                "id": 7,
                "name": "ইন্দুরকানী"
            }
        ]
    },
    {
        "id": 53,
        "name": "রাজবাড়ী",
        "upazilas": [
            {
                "id": 1,
                "name": "রাজবাড়ী সদর"
            },
            {
                "id": 2,
                "name": "গোয়ালন্দ"
            },
            {
                "id": 3,
                "name": "পাংশা"
            },
            {
                "id": 4,
                "name": "বালিয়াকান্দি"
            },
            {
                "id": 5,
                "name": "কালুখালী"
            }
        ]
    },
    {
        "id": 54,
        "name": "রাজশাহী",
        "upazilas": [
            {
                "id": 1,
                "name": "পবা"
            },
            {
                "id": 2,
                "name": "দুর্গাপুর"
            },
            {
                "id": 3,
                "name": "মোহনপুর"
            },
            {
                "id": 4,
                "name": "চারঘাট"
            },
            {
                "id": 5,
                "name": "পুঠিয়া"
            },
            {
                "id": 6,
                "name": "বাঘা"
            },
            {
                "id": 7,
                "name": "গোদাগাড়ী"
            },
            {
                "id": 8,
                "name": "তানোর"
            },
            {
                "id": 9,
                "name": "বাগমারা"
            }
        ]
    },
    {
        "id": 55,
        "name": "রাঙ্গামাটি",
        "upazilas": [
            {
                "id": 1,
                "name": "রাঙ্গামাটি সদর"
            },
            {
                "id": 2,
                "name": "কাপ্তাই"
            },
            {
                "id": 3,
                "name": "কাউখালী"
            },
            {
                "id": 4,
                "name": "বাঘাইছড়ি"
            },
            {
                "id": 5,
                "name": "বরকল"
            },
            {
                "id": 6,
                "name": "লংগদু"
            },
            {
                "id": 7,
                "name": "রাজস্থলী"
            },
            {
                "id": 8,
                "name": "বিলাইছড়ি"
            },
            {
                "id": 9,
                "name": "জুরাছড়ি"
            },
            {
                "id": 10,
                "name": "নানিয়ারচর"
            }
        ]
    },
    {
        "id": 56,
        "name": "রংপুর",
        "upazilas": [
            {
                "id": 1,
                "name": "রংপুর সদর"
            },
            {
                "id": 2,
                "name": "গংগাচড়া"
            },
            {
                "id": 3,
                "name": "তারাগঞ্জ"
            },
            {
                "id": 4,
                "name": "বদরগঞ্জ"
            },
            {
                "id": 5,
                "name": "মিঠাপুকুর"
            },
            {
                "id": 6,
                "name": "পীরগঞ্জ"
            },
            {
                "id": 7,
                "name": "কাউনিয়া"
            },
            {
                "id": 8,
                "name": "পীরগাছা"
            }
        ]
    },
    {
        "id": 57,
        "name": "সাতক্ষীরা",
        "upazilas": [
            {
                "id": 1,
                "name": "আশাশুনি"
            },
            {
                "id": 2,
                "name": "দেবহাটা"
            },
            {
                "id": 3,
                "name": "কলারোয়া"
            },
            {
                "id": 4,
                "name": "সাতক্ষীরা সদর"
            },
            {
                "id": 5,
                "name": "শ্যামনগর"
            },
            {
                "id": 6,
                "name": "তালা"
            },
            {
                "id": 7,
                "name": "কালিগঞ্জ"
            }
        ]
    },
    {
        "id": 58,
        "name": "শরিয়তপুর",
        "upazilas": [
            {
                "id": 1,
                "name": "শরিয়তপুর সদর"
            },
            {
                "id": 2,
                "name": "নড়িয়া"
            },
            {
                "id": 3,
                "name": "জাজিরা"
            },
            {
                "id": 4,
                "name": "গোসাইরহাট"
            },
            {
                "id": 5,
                "name": "ভেদরগঞ্জ"
            },
            {
                "id": 6,
                "name": "ডামুড্যা"
            }
        ]
    },
    {
        "id": 59,
        "name": "শেরপুর",
        "upazilas": [
            {
                "id": 1,
                "name": "শেরপুর সদর"
            },
            {
                "id": 2,
                "name": "নালিতাবাড়ী"
            },
            {
                "id": 3,
                "name": "শ্রীবরদী"
            },
            {
                "id": 4,
                "name": "নকলা"
            },
            {
                "id": 5,
                "name": "ঝিনাইগাতী"
            }
        ]
    },
    {
        "id": 60,
        "name": "সিরাজগঞ্জ",
        "upazilas": [
            {
                "id": 1,
                "name": "বেলকুচি"
            },
            {
                "id": 2,
                "name": "চৌহালি"
            },
            {
                "id": 3,
                "name": "কামারখন্দ"
            },
            {
                "id": 4,
                "name": "কাজীপুর"
            },
            {
                "id": 5,
                "name": "রায়গঞ্জ"
            },
            {
                "id": 6,
                "name": "শাহজাদপুর"
            },
            {
                "id": 7,
                "name": "সিরাজগঞ্জ"
            },
            {
                "id": 8,
                "name": "তাড়াশ"
            },
            {
                "id": 9,
                "name": "উল্লাপাড়া"
            }
        ]
    },
    {
        "id": 61,
        "name": "সুনামগঞ্জ",
        "upazilas": [
            {
                "id": 1,
                "name": "সুনামগঞ্জ সদর"
            },
            {
                "id": 2,
                "name": "দক্ষিণ সুনামগঞ্জ"
            },
            {
                "id": 3,
                "name": "বিশ্বম্ভরপুর"
            },
            {
                "id": 4,
                "name": "ছাতক"
            },
            {
                "id": 5,
                "name": "জগন্নাথপুর"
            },
            {
                "id": 6,
                "name": "দোয়ারাবাজার"
            },
            {
                "id": 7,
                "name": "তাহিরপুর"
            },
            {
                "id": 8,
                "name": "ধর্মপাশা"
            },
            {
                "id": 9,
                "name": "জামালগঞ্জ"
            },
            {
                "id": 10,
                "name": "শাল্লা"
            },
            {
                "id": 11,
                "name": "দিরাই"
            },
            {
                "id": 12,
                "name": "মধ্যনগর"
            }
        ]
    },
    {
        "id": 62,
        "name": "সিলেট",
        "upazilas": [
            {
                "id": 1,
                "name": "বালাগঞ্জ"
            },
            {
                "id": 2,
                "name": "বিয়ানীবাজার"
            },
            {
                "id": 3,
                "name": "বিশ্বনাথ"
            },
            {
                "id": 4,
                "name": "কোম্পানীগঞ্জ"
            },
            {
                "id": 5,
                "name": "ফেঞ্চুগঞ্জ"
            },
            {
                "id": 6,
                "name": "গোলাপগঞ্জ"
            },
            {
                "id": 7,
                "name": "গোয়াইনঘাট"
            },
            {
                "id": 8,
                "name": "জৈন্তাপুর"
            },
            {
                "id": 9,
                "name": "কানাইঘাট"
            },
            {
                "id": 10,
                "name": "সিলেট সদর"
            },
            {
                "id": 11,
                "name": "জকিগঞ্জ"
            },
            {
                "id": 12,
                "name": "দক্ষিণ সুরমা"
            },
            {
                "id": 13,
                "name": "ওসমানী"
            }
        ]
    },
    {
        "id": 63,
        "name": "টাঙ্গাইল",
        "upazilas": [
            {
                "id": 1,
                "name": "বাসাইল"
            },
            {
                "id": 2,
                "name": "ভুয়াপুর"
            },
            {
                "id": 3,
                "name": "দেলদুয়ার"
            },
            {
                "id": 4,
                "name": "ঘাটাইল"
            },
            {
                "id": 5,
                "name": "গোপালপুর"
            },
            {
                "id": 6,
                "name": "মধুপুর"
            },
            {
                "id": 7,
                "name": "মির্জাপুর"
            },
            {
                "id": 8,
                "name": "নাগরপুর"
            },
            {
                "id": 9,
                "name": "সখিপুর"
            },
            {
                "id": 10,
                "name": "টাঙ্গাইল সদর"
            },
            {
                "id": 11,
                "name": "কালিহাতী"
            },
            {
                "id": 12,
                "name": "ধনবাড়ী"
            }
        ]
    },
    {
        "id": 64,
        "name": "ঠাকুরগাঁও",
        "upazilas": [
            {
                "id": 1,
                "name": "ঠাকুরগাঁও সদর"
            },
            {
                "id": 2,
                "name": "পীরগঞ্জ"
            },
            {
                "id": 3,
                "name": "রাণীশংকৈল"
            },
            {
                "id": 4,
                "name": "হরিপুর"
            },
            {
                "id": 5,
                "name": "বালিয়াডাঙ্গী"
            }
        ]
    }
]

const upazilasBn = ref(null);



const selectedDistrictEnOptions = districtsEn.find(district => district.name == props.selectedEnDistrict);

if (selectedDistrictEnOptions) {

    selectedDistrictEn.value = { id: selectedDistrictEnOptions.id, name: selectedDistrictEnOptions.name };
    upazilasEn.value = selectedDistrictEnOptions.upazilas
    const selectedUpazilaEnOptions = upazilasEn.value.find(upazila => upazila.name == props.selectedEnUpazila);

    if (selectedUpazilaEnOptions) {
        selectedUpazilaEn.value = { id: selectedUpazilaEnOptions.id, name: selectedUpazilaEnOptions.name };
    } else {
        selectedUpazilaEn.value = { id: '', name: '' };
    }

} else {
    selectedDistrictEn.value = { id: '', name: '' };
}


const selectedDistrictBnOptions = districtsBn.find(district => district.name == props.selectedBnDistrict);

if (selectedDistrictBnOptions) {

    selectedDistrictBn.value = { id: selectedDistrictBnOptions.id, name: selectedDistrictBnOptions.name };
    upazilasBn.value = selectedDistrictBnOptions.upazilas
    const selectedUpazilaBnOptions = upazilasBn.value.find(upazila => upazila.name == props.selectedBnUpazila);

    if (selectedUpazilaBnOptions) {
        selectedUpazilaBn.value = { id: selectedUpazilaBnOptions.id, name: selectedUpazilaBnOptions.name };
    } else {
        selectedUpazilaBn.value = { id: '', name: '' };
    }

} else {
    selectedDistrictBn.value = { id: '', name: '' };
}

const handleDistrictSelected = (selectedLabel) => {
    const selectedId = parseInt(selectedLabel); // Convert selected label to integer

    // Find the district by ID in English
    const selectedEnDistrict = districtsEn.find(district => district.id === selectedId);
    if (selectedEnDistrict) {
        selectedDistrictEn.value = { id: selectedEnDistrict.id, name: selectedEnDistrict.name }
        console.log(selectedDistrictEn.value);
        upazilasEn.value = selectedEnDistrict.upazilas
    }

    // Find the district by ID in Bengali
    const selectedBnDistrict = districtsBn.find(district => district.id === selectedId);
    if (selectedBnDistrict) {
        selectedDistrictBn.value = { id: selectedBnDistrict.id, name: selectedBnDistrict.name }
        upazilasBn.value = selectedBnDistrict.upazilas
    }
    emit('district-selected', {
        en: selectedEnDistrict.name,
        bn: selectedBnDistrict.name,
    });
};

const handleUpazilaSelected = (selectedLabel) => {
    const selectedId = parseInt(selectedLabel); // Convert selected label to integer

    // Find the upazila by ID in English
    const selectedEnUpazila = upazilasEn.value.find(upazila => upazila.id === selectedId);
        selectedUpazilaEn.value = { id: selectedEnUpazila.id, name: selectedEnUpazila.name }
    // Find the upazila by ID in Bengali
    const selectedBnUpazila = upazilasBn.value.find(upazila => upazila.id === selectedId);
    selectedUpazilaBn.value = { id: selectedBnUpazila.id, name: selectedBnUpazila.name }

    emit('upazila-selected', {
        en: selectedEnUpazila.name,
        bn: selectedBnUpazila.name,
    });
};

// onMounted(() => {
//     emit('district-selected', {
//         en: selectedDistrictEn.name,
//         bn: selectedDistrictBn.name,
//     });
//     emit('upazila-selected', {
//         en: selectedUpazilaEn.name,
//         bn: selectedUpazilaBn.name,
//     });
// });


</script>


<template>
    <div class="col-span-6 sm:col-span-4">
        <InputLabel :for="props.lang == 'en' ? 'district_en' : 'district_bn'"
            :value="props.lang == 'en' ? 'District (English)' : 'District (বাংলা)'">
            <!-- <template #required>*</template> -->
        </InputLabel>
        <SelectInput :options="props.lang == 'en' ? districtsEn : districtsBn"
            :inputName="props.lang == 'en' ? 'district_en' : 'district_bn'" :fieldName="props.fieldName"
            :valueField="props.valueField" :selectedOption="props.lang == 'en' ? selectedDistrictEn : selectedDistrictBn"
            @option-selected="handleDistrictSelected" class="capitalize" />
        <!-- <InputError :message="props.error" class="text-red-500" /> -->
    </div>
    <div class="col-span-6 sm:col-span-4">
        <InputLabel :for="props.lang == 'en' ? 'upazila_en' : 'upazila_bn'"
            :value="props.lang == 'en' ? 'Upazila (English)' : 'Upazila (বাংলা)'">
            <!-- <template #required>*</template> -->
        </InputLabel>
        <SelectInput :options="props.lang == 'en' ? upazilasEn : upazilasBn"
            :inputName="props.lang == 'en' ? 'upazila_en' : 'upazila_bn'" :fieldName="props.fieldName"
            :valueField="props.valueField" :selectedOption="props.lang == 'en' ? selectedUpazilaEn : selectedUpazilaBn"
            @option-selected="handleUpazilaSelected" class="capitalize" />
        <!-- <InputError :message="form.errors.religion_en" class="text-red-500" /> -->
    </div>
</template>