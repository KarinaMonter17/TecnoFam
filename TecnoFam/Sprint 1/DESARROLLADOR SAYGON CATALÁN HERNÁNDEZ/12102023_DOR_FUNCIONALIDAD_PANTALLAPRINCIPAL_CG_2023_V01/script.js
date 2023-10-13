document.getElementById("showMissionForm").addEventListener("click", function () {
    document.getElementById("missionForm").style.display = "block";
    const missionText = localStorage.getItem("missionText");
    document.getElementById("newMissionText").value = missionText || "";
});

document.getElementById("saveMissionButton").addEventListener("click", function () {
    const newMissionText = document.getElementById("newMissionText").value;
    if (/^[A-Za-záéíóúÁÉÍÓÚüÜ,.ñÑ\s]+$/.test(newMissionText)) {
        document.getElementById("missionText").textContent = newMissionText;
        localStorage.setItem("missionText", newMissionText);
        document.getElementById("missionForm").style.display = "none";
    } else {
        alert("Por favor, elimine los caracteres no permitidos del campo de Misión antes de guardar.");
    }
});

document.getElementById("showVissionForm").addEventListener("click", function () {
    document.getElementById("vissionForm").style.display = "block";
    const vissionText = localStorage.getItem("vissionText");
    document.getElementById("newVissionText").value = vissionText || "";
});

document.getElementById("saveVissionButton").addEventListener("click", function () {
    const newVissionText = document.getElementById("newVissionText").value;
    if (/^[A-Za-záéíóúÁÉÍÓÚüÜ,.ñÑ\s]+$/.test(newVissionText)) {
        document.getElementById("vissionText").textContent = newVissionText;
        localStorage.setItem("vissionText", newVissionText);
        document.getElementById("vissionForm").style.display = "none";
    } else {
        alert("Por favor, elimine los caracteres no permitidos del campo de Visión antes de guardar.");
    }
});
