const dom = {
    cpuPorcentagem: document.getElementById('cpu-porcentagem'),
    cpuMeter: document.getElementById('cpu-meter'),
    ramPorcentagem: document.getElementById('ram-porcentagem'),
    ramMeter: document.getElementById('ram-meter'),
    diskPorcentagem: document.getElementById('disk-porcentagem'),
    diskMeter: document.getElementById('disk-meter')
};

async function getDisk() {
    try {
        const resp = await fetch('/api/system/disk');
        const data = await resp.json();
        return data;
    } catch (error) {
        return error;
    }
}

async function getRAM() {
    try {
        const resp = await fetch('/api/system/ram');
        const data = await resp.json();
        return data;
    } catch (error) {
        return error;
    }
}

async function getCpu() {
    try {
        const resp = await fetch('/api/system/cpu');
        const data = await resp.json();
        return data;
    } catch (error) {
        return error;
    }
}

async function getStatus() {
    const [cpu, ram, disk] = await Promise.all([
        getCpu(),
        getRAM(),
        getDisk()
    ]);

    dom.diskPorcentagem.textContent = `${disk.porcentagem}%`;
    dom.diskMeter.value = disk.porcentagem;

    dom.ramPorcentagem.textContent = `${ram.porcentagem}%`;
    dom.ramMeter.value = ram.porcentagem;

    dom.cpuPorcentagem.textContent = `${cpu.porcentagem}%`;
    dom.cpuMeter.value = cpu.porcentagem;
}

const intervalo = 5000;
getStatus();
setInterval(getStatus, intervalo);