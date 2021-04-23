const my = "https://covid19.th-stat.com/api/open/today" ;

async function get(){
    const response = await fetch(my);
    const data = await response.json();
    const { NewConfirmed , Confirmed , UpdateDate} = data;
    
    document.getElementById('new').innerHTML = '<b>' + NewConfirmed + "</b>";
    document.getElementById('con').innerHTML = '<b>' + Confirmed + "</b>" + " Update at " + UpdateDate;
    
}
get();