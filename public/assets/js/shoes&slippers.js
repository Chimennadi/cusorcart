const selectOptions = {
    womens: {
        eur: `<option selected="" value="" disabled="">Select Your Size</option><option value="35">35</option><option value="35">35</option><option value="35-36">35-36</option><option value="36">36</option><option value="36-37">36-37</option><option value="37">37</option><option value="37-38">37-38</option><option value="38">38</option><option value="38-39">38-39</option><option value="39">39</option><option value="39-40">39-40</option><option value="40">40</option><option value="40-41">40-41</option><option value="41">41</option><option value="41-42">41-42</option><option value="42">42</option><option value="42-43">42-43</option>`,
        usac: `<option selected="" value="" disabled="">Select Your Size</option><option value="4">4</option><option value="4.5">4.5</option><option value="5">5</option><option value="5.5">5.5</option><option value="6">6</option><option value="6.5">6.5</option><option value="7">7</option><option value="7.5">7.5</option><option value="8">8</option><option value="8.5">8.5</option><option value="9">9</option><option value="9.5">9.5</option><option value="10">10</option><option value="10.5">10.5</option><option value="11">11</option><option value="11.5">11.5</option><option value="12">12</option>`,
        uk: `<option selected="" value="" disabled="">Select Your Size</option><option value="2">2</option><option value="2.5">2.5</option><option value="3">3</option><option value="3.5">3.5</option><option value="4">4</option><option value="4.5">4.5</option><option value="5">5</option><option value="5.5">5.5</option><option value="6">6</option><option value="6.5">6.5</option><option value="7">7</option><option value="7.5">7.5</option><option value="8">8</option><option value="8.5">8.5</option><option value="9">9</option><option value="9.5">9.5</option><option value="10">10</option>`,
        cm: `<option selected="" value="" disabled="">Select Your Size</option><option value="20.8">20.8</option><option value="21.3">21.3</option><option value="21.6">21.6</option><option value="22.2">22.2</option><option value="22.5">22.5</option><option value="23">23</option><option value="23.5">23.5</option><option value="23.8">23.8</option><option value="24.1">24.1</option><option value="24.6">24.6</option><option value="25.1">25.1</option><option value="25.4">25.4</option><option value="25.9">25.9</option><option value="26.2">26.2</option><option value="26.7">26.7</option><option value="27.1">27.1</option><option value="27.6">27.6</option>`,
        in: `<option selected="" value="" disabled="">Select Your Size</option><option value="8.2">8.2</option><option value="8.3">8.3</option><option value="8.5">8.5</option><option value="8.8">8.8</option><option value="8.9">8.9</option><option value="9.1">9.1</option><option value="9.3">9.3</option><option value="9.4">9.4</option><option value="9.5">9.5</option><option value="9.7">9.7</option><option value="9.9">9.9</option><option value="10">10</option><option value="10.2">10.2</option><option value="10.3">10.3</option><option value="10.5">10.5</option><option value="10.7">10.7</option><option value="10.9">10.9</option>`,
    },

    mens: {
        eur: `<option selected="" value="" disabled="">Select Your Size</option><option value="39">39</option><option value="39">39</option><option value="40">40</option><option value="40-41">40-41</option><option value="41">41</option><option value="41-42">41-42</option><option value="42">42</option><option value="42-43">42-43</option><option value="43">43</option><option value="43-44">43-44</option><option value="44">44</option><option value="44-45">44-45</option><option value="45">45</option><option value="46">46</option><option value="47">47</option><option value="48">48</option><option value="49">49</option>`,
        usac: `<option selected="" value="" disabled="">Select Your Size</option><option value="6">6</option><option value="6.5">6.5</option><option value="7">7</option><option value="7.5">7.5</option><option value="8">8</option><option value="8.5">8.5</option><option value="9">9</option><option value="9.5">9.5</option><option value="10">10</option><option value="10.5">10.5</option><option value="11">11</option><option value="11.5">11.5</option><option value="12">12</option><option value="13">13</option><option value="14">14</option><option value="15">15</option><option value="16">16</option>`,
        uk: `<option selected="" value="" disabled="">Select Your Size</option><option value="5.5">5.5</option><option value="6">6</option><option value="6.5">6.5</option><option value="7">7</option><option value="7.5">7.5</option><option value="8">8</option><option value="8.5">8.5</option><option value="9">9</option><option value="9.5">9.5</option><option value="10">10</option><option value="10.5">10.5</option><option value="11">11</option><option value="11.5">11.5</option><option value="12.5">12.5</option><option value="13.5">13.5</option><option value="14.5">14.5</option><option value="15.5">15.5</option>`,
        cm: `<option selected="" value="" disabled="">Select Your Size</option><option value="23.5">23.5</option><option value="24.1">24.1</option><option value="24.4">24.4</option><option value="24.8">24.8</option><option value="25.4">25.4</option><option value="25.7">25.7</option><option value="26">26</option><option value="26.7">26.7</option><option value="27">27</option><option value="27.3">27.3</option><option value="27.9">27.9</option><option value="28.3">28.3</option><option value="28.6">28.6</option><option value="29.4">29.4</option><option value="30.2">30.2</option><option value="31">31</option><option value="31.8">31.8</option>`,
        in: `<option selected="" value="" disabled="">Select Your Size</option><option value="9.3">9.3</option><option value="9.5">9.5</option><option value="9.6">9.6</option><option value="9.8">9.8</option><option value="9.9">9.9</option><option value="10.1">10.1</option><option value="10.3">10.3</option><option value="10.4">10.4</option><option value="10.6">10.6</option><option value="10.8">10.8</option><option value="10.9">10.9</option><option value="11.1">11.1</option><option value="11.3">11.3</option><option value="11.6">11.6</option><option value="11.9">11.9</option><option value="12.2">12.2</option><option value="12.5">12.5</option>`,
    },
    bigkids: {
        eur: `<option selected="" value="" disabled="">Select Your Size</option><option value="35">35</option><option value="36">36</option><option value="36">36</option><option value="37">37</option><option value="37">37</option><option value="38">38</option><option value="38">38</option><option value="39">39</option>`,
        usac: `<option selected="" value="" disabled="">Select Your Size</option><option value="3.5">3.5</option><option value="4">4</option><option value="4.5">4.5</option><option value="5">5</option><option value="5.5">5.5</option><option value="6">6</option><option value="6.5">6.5</option><option value="7">7</option>`,
        uk: `<option selected="" value="" disabled="">Select Your Size</option><option value="2.5">2.5</option><option value="3">3</option><option value="3.5">3.5</option><option value="4">4</option><option value="4.5">4.5</option><option value="5">5</option><option value="5.5">5.5</option><option value="6">6</option>`,
        cm: `<option selected="" value="" disabled="">Select Your Size</option><option value="21.9">21.9</option><option value="22.2">22.2</option><option value="22.9">22.9</option><option value="23.2">23.2</option><option value="23.5">23.5</option><option value="24.1">24.1</option><option value="24.4">24.4</option><option value="24.8">24.8</option>`,
        in: `<option selected="" value="" disabled="">Select Your Size</option><option value="8.6">8.6</option><option value="8.8">8.8</option><option value="9">9</option><option value="9.1">9.1</option><option value="9.3">9.3</option><option value="9.5">9.5</option><option value="9.6">9.6</option><option value="9.8">9.8</option>`,
    },
    littlekids: {
        eur: `<option selected="" value="" disabled="">Select Your Size</option><option value="27">27</option><option value="28">28</option><option value="29">29</option><option value="30">30</option><option value="30">30</option><option value="31">31</option><option value="31">31</option><option value="32">32</option><option value="33">33</option><option value="33">33</option><option value="34">34</option><option value="34">34</option>`,
        usac: `<option selected="" value="" disabled="">Select Your Size</option><option value="10.5">10.5</option><option value="11">11</option><option value="11.5">11.5</option><option value="12">12</option><option value="12.5">12.5</option><option value="13">13</option><option value="13.5">13.5</option><option value="1">1</option><option value="1.5">1.5</option><option value="2">2</option><option value="2.5">2.5</option><option value="3">3</option>`,
        uk: `<option selected="" value="" disabled="">Select Your Size</option><option value="9.5">9.5</option><option value="10">10</option><option value="10.5">10.5</option><option value="11">11</option><option value="11.5">11.5</option><option value="12">12</option><option value="12.5">12.5</option><option value="13">13</option><option value="14">14</option><option value="1">1</option><option value="1.5">1.5</option><option value="2">2</option>`,
        cm: `<option selected="" value="" disabled="">Select Your Size</option><option value="16.8">16.8</option><option value="17.1">17.1</option><option value="17.8">17.8</option><option value="18.1">18.1</option><option value="18.4">18.4</option><option value="19.1">19.1</option><option value="19.4">19.4</option><option value="19.7">19.7</option><option value="20.3">20.3</option><option value="20.6">20.6</option><option value="21">21</option><option value="21.6">21.6</option>`,
        in: `<option selected="" value="" disabled="">Select Your Size</option><option value="6.6">6.6</option><option value="6.8">6.8</option><option value="7">7</option><option value="7.1">7.1</option><option value="7.3">7.3</option><option value="7.5">7.5</option><option value="7.6">7.6</option><option value="7.8">7.8</option><option value="8">8</option><option value="8.1">8.1</option><option value="8.3">8.3</option><option value="8.5">8.5</option>`,
    },
    toddler: {
        eur: `<option selected="" value="" disabled="">Select Your Size</option><option value="2.5">2.5</option><option value="3">3</option><option value="3.5">3.5</option><option value="4">4</option><option value="4.5">4.5</option><option value="5">5</option><option value="5.5">5.5</option><option value="6">6</option><option value="6.5">6.5</option><option value="7">7</option><option value="7.5">7.5</option><option value="8">8</option><option value="8.5">8.5</option><option value="9">9</option>`,
        usac: `<option selected="" value="" disabled="">Select Your Size</option><option value="3.5">3.5</option><option value="4">4</option><option value="4.5">4.5</option><option value="5">5</option><option value="5.5">5.5</option><option value="6">6</option><option value="6.5">6.5</option><option value="7">7</option><option value="7.5">7.5</option><option value="8">8</option><option value="8.5">8.5</option><option value="9">9</option><option value="9.5">9.5</option><option value="10">10</option>`,
        uk: `<option selected="" value="" disabled="">Select Your Size</option><option value="19">19</option><option value="19">19</option><option value="20">20</option><option value="20">20</option><option value="21">21</option><option value="22">22</option><option value="22">22</option><option value="23">23</option><option value="23">23</option><option value="24">24</option><option value="25">25</option><option value="25">25</option><option value="26">26</option><option value="27">27</option>`,
        cm: `<option selected="" value="" disabled="">Select Your Size</option><option value="10.8">10.8</option><option value="11.4">11.4</option><option value="11.7">11.7</option><option value="12.1">12.1</option><option value="12.7">12.7</option><option value="13">13</option><option value="13.3">13.3</option><option value="14">14</option><option value="14.3">14.3</option><option value="14.6">14.6</option><option value="15.2">15.2</option><option value="15.6">15.6</option><option value="15.9">15.9</option><option value="16.5">16.5</option>`,
        in: `<option selected="" value="" disabled="">Select Your Size</option><option value="4.3">4.3</option><option value="4.5">4.5</option><option value="4.6">4.6</option><option value="4.8">4.8</option><option value="5">5</option><option value="5.1">5.1</option><option value="5.3">5.3</option><option value="5.5">5.5</option><option value="5.6">5.6</option><option value="5.8">5.8</option><option value="6">6</option><option value="6.1">6.1</option><option value="6.3">6.3</option><option value="6.5">6.5</option>`,
    },
    infant: {
        eur: `<option selected="" value="" disabled="">Select Your Size</option><option value="15">15</option><option value="16">16</option><option value="17">17</option><option value="17">17</option><option value="18">18</option><option value="18">18</option>`,
        usac: `<option selected="" value="" disabled="">Select Your Size</option><option value="0">0</option><option value="1">1</option><option value="1.5">1.5</option><option value="2">2</option><option value="2.5">2.5</option><option value="3">3</option>`,
        uk: `<option selected="" value="" disabled="">Select Your Size</option><option value="0">0</option><option value="0.5">0.5</option><option value="1">1</option><option value="1">1</option><option value="1.5">1.5</option><option value="2">2</option>`,
        cm: `<option selected="" value="" disabled="">Select Your Size</option><option value="7.9">7.9</option><option value="8.9">8.9</option><option value="9.2">9.2</option><option value="9.5">9.5</option><option value="10.2">10.2</option><option value="10.5">10.5</option>`,
        in: `<option selected="" value="" disabled="">Select Your Size</option><option value="3.1">3.1</option><option value="3.5">3.5</option><option value="3.6">3.6</option><option value="3.8">3.8</option><option value="4">4</option><option value="4.1">4.1</option>`,
    },
};
const setSelectedData = (sizeType, gender) => {
    $("#size_type").val(sizeType);
    $("#user_gender").val(gender);
    const options = selectOptions[gender][sizeType];
    // console.log(options);
    $("#size").html(options);
};

$(document).ready(() => {
    $("#select_size_type").change((e) => {
        const sizeType = e.target.value,
            gender = $("#gender").val();
        if (sizeType.length > 0 && gender.length > 0) {
            setSelectedData(sizeType, gender);
        } else {
            $("#size").html(
                `<option selected="" value="" disabled="">Select Your Size</option>`
            );
        }
    });
    $("#gender").change((e) => {
        const sizeType = $("#select_size_type").val(),
            gender = e.target.value;
        if (sizeType.length > 0 && gender.length > 0) {
            setSelectedData(sizeType, gender);
        } else {
            $("#size").html(
                `<option selected="" value="" disabled="">Select Your Size</option>`
            );
        }
        console.log(e.target.value);
    });
    $("#size").change((e) => {
        if (e.target.value.length > 0) $("#leg_size").val(e.target.value);
    });
});
