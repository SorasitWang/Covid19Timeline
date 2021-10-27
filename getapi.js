

async function get(){
    const response = await fetch("https://covid19.ddc.moph.go.th/api/Cases/today-cases-all");
    const data = await response.json();
    //const { new_case , total_case , update_date} = data;
    console.log(data[0])
    document.getElementById('new').innerHTML = '<b>' + data[0].new_case+ "</b>";
    document.getElementById('con').innerHTML = '<b>' + data[0].total_case + "</b>" + " Update at " + data[0].update_date;
    
}
get();