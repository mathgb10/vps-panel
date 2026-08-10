// Placeholders
const dom = {
    cpuPorcentagem: document.getElementById('cpu-porcentagem'),
    cpuMeter: document.getElementById('cpu-meter'),
    ramPorcentagem: document.getElementById('ram-porcentagem'),
    ramMeter: document.getElementById('ram-meter'),
    ramTotal: document.getElementById('ram-total'),
    ramUsado: document.getElementById('ram-usado'),
    ramDisponivel: document.getElementById('ram-disponivel'),
    diskTotal: document.getElementById('disk-total'),
    diskUsado: document.getElementById('disk-usado'),
    diskDisponivel: document.getElementById('disk-disponivel'),
    diskPorcentagem: document.getElementById('disk-porcentagem'),
    diskMeter: document.getElementById('disk-meter')
};

// Consulta minha API e retorna em JSON
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

    // Inserindo informações nos placeholders
    // DISCO
    dom.diskPorcentagem.textContent = `${disk.porcentagem}%`;
    dom.diskMeter.value = disk.porcentagem;
    dom.diskTotal.textContent = `${disk.total} GB`;
    dom.diskUsado.textContent = `${disk.usado} GB`;
    dom.diskDisponivel.textContent = `${disk.disponivel} GB`;
    
    // RAM
    dom.ramPorcentagem.textContent = `${ram.porcentagem}%`;
    dom.ramMeter.value = ram.porcentagem;
    dom.ramTotal.textContent = `${ram.total} GB`;
    dom.ramUsado.textContent = `${ram.usado} GB`;
    dom.ramDisponivel.textContent = `${ram.disponivel} GB`;

    // CPU
    dom.cpuPorcentagem.textContent = `${cpu.porcentagem}%`;
    dom.cpuMeter.value = cpu.porcentagem;
}

getStatus();

// Vai chamar a função a cada 5 segundos.
const intervalo = 5000;
setInterval(getStatus, intervalo);