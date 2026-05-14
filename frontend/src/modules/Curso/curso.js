import React, { useState, useEffect } from 'react';
import '../../styles/Dashboard.css';

function Horarios() {
    const [clases, setClases] = useState([]);

    useEffect(() => {
        // En microservicios, llamarías directamente al servicio académico
        fetch('http://api-gateway.com/academic/my-schedule')
            .then(response => response.json())
            .then(data => setClases(data));
    }, []);

    return (
        <div className="card">
            <h3>Mis Horarios</h3>
            <table>
                <thead>
                    <tr>
                        <th>Materia</th>
                        <th>Hora</th>
                        <th>Aula</th>
                    </tr>
                </thead>
                <tbody>
                    {clases.map((clase, index) => (
                        <tr key={index}>
                            <td>{clase.nombre}</td>
                            <td>{clase.hora}</td>
                            <td>{clase.aula}</td>
                        </tr>
                    ))}
                </tbody>
            </table>
        </div>
    );
}

export default Horarios;