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


// Pega o valor em bytes e converte para a unidade correta
function formatarBytes(bytes, decimals = 2) {
    if (bytes === 0) return '0 Bytes';
    const k = 1024;
    const dm = decimals < 0 ? 0 : decimals;
    const sizes = ['Bytes', 'KB', 'MB', 'GB', 'TB', 'PB', 'EB', 'ZB', 'YB'];

    const i = Math.floor(Math.log(bytes) / Math.log(k));

    return parseFloat((bytes / Math.pow(k, i)).toFixed(dm)) + ' ' + sizes[i];
}

// Consulta minha API e retorna em JSON
async function getDisk() {
    try {
        const resp = await fetch('/api/system/disk');
        const data = await resp.json();
        return data;
    } catch (error) {
        console.error('Erro ao buscar disco:', error);
        return null;
    }
}


async function getRAM() {
    try {
        const resp = await fetch('/api/system/ram');
        const data = await resp.json();
        return data;
    } catch (error) {
        console.error('Erro ao buscar RAM:', error);
        return null;
    }
}


async function getCpu() {
    try {
        const resp = await fetch('/api/system/cpu');
        const data = await resp.json();
        return data;
    } catch (error) {
        console.error('Erro ao buscar CPU:', error);
        return null;
    }
}


// Atualiza as informações do painel
async function getStatus() {
    const [cpu, ram, disk] = await Promise.all([
        getCpu(),
        getRAM(),
        getDisk()
    ]);

    // DISCO
    dom.diskPorcentagem.textContent = `${disk.porcentagem.toFixed(2)}%`;
    dom.diskMeter.value = disk.porcentagem;
    dom.diskTotal.textContent = formatarBytes(disk.total);
    dom.diskUsado.textContent = formatarBytes(disk.usado);
    dom.diskDisponivel.textContent = formatarBytes(disk.disponivel);

    // RAM
    dom.ramPorcentagem.textContent = `${ram.porcentagem.toFixed(2)}%`;
    dom.ramMeter.value = ram.porcentagem;
    dom.ramTotal.textContent = formatarBytes(ram.total * 1024);
    dom.ramUsado.textContent = formatarBytes(ram.usado * 1024);
    dom.ramDisponivel.textContent = formatarBytes(ram.disponivel * 1024);

    // CPU
    dom.cpuPorcentagem.textContent = `${cpu.porcentagem.toFixed(2)}%`;
    dom.cpuMeter.value = cpu.porcentagem;
}


// Executa imediatamente
getStatus();

// Atualiza a cada 5 segundos
const intervalo = 5000;
setInterval(getStatus, intervalo);