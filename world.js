document.getElementById('lookup-cities').addEventListener('click',function()
{
    const country = document.getElementById('country').value;
    fetch(`world.php?country=${country}&lookup-cities`)
    .then(Response => Response.text())
    .then(data => document.getElementById('result').innerHTML = data);
});