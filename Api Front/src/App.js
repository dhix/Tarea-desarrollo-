import React, { useState , useEffect } from 'react';
import './App.css';
import 'bootstrap/dist/css/bootstrap.min.css';
import axios from 'axios';
import {Modal, ModalBody, ModalFooter, ModalHeader} from 'reactstrap';

function App() {

  const baseUrl ="https://localhost:5001/api/empleados";
  const [data, setData]=useState([]);
  const [modalInsertar, setModalInsertar]=useState(false);
  const [modalEditar, setModalEditar]=useState(false);
  const [modalEliminar, setModalEliminar]=useState(false);
  const [empleadoSeleccionado, setEmpleadoSeleccionado]=useState({
    id: '',
    codigo: '',
    nombres: '',
    apellidos: '',
    direccion: '',
    telefono: '',
    fecha_nacimiento: '',
    id_puesto: ''
  })

  const handleChange=e=>{
    const {name, value}=e.target;
    setEmpleadoSeleccionado({
      ...empleadoSeleccionado,
      [name]: value
    });
    console.log(empleadoSeleccionado);

  }

  const abrirCerarModalInsertar=()=>{
    setModalInsertar(!modalInsertar);
  }

  const abrirCerarModalEditar=()=>{
    setModalEditar(!modalEditar);
  }

  const abrirCerarModalEliminar=()=>{
    setModalEliminar(!modalEliminar);
  }

  const peticionGet=async()=>{
    await axios.get(baseUrl)
    .then(Response=>{
      setData(Response.data);
    }).catch(error=>{
      console.log(error);
    })

  }

  const peticionPost=async()=>{
    delete empleadoSeleccionado.id;
    empleadoSeleccionado.id_puesto=parseInt(empleadoSeleccionado.id_puesto);
    await axios.post(baseUrl, empleadoSeleccionado)
    .then(Response=>{
      setData(data.concat(Response.data));
      abrirCerarModalInsertar();
    }).catch(error=>{
      console.log(error);
    })

  }

  const peticionPut=async()=>{
    empleadoSeleccionado.id_puesto=parseInt(empleadoSeleccionado.id_puesto);
    await axios.put(baseUrl+"/"+empleadoSeleccionado.id, empleadoSeleccionado)
    .then(response=>{
      var respuesta =response.data;
      var dataAuxiliar=data;
      dataAuxiliar.map(empleados=>{
        if(empleados.id===empleadoSeleccionado.id){
          empleados.codigo=respuesta.codigo;
          empleados.nombres=respuesta.nombres;
          empleados.apellidos=respuesta.apellidos;
          empleados.direccion=respuesta.direccion;
          empleados.telefono=respuesta.telefono;
          empleados.fecha_nacimiento=respuesta.fecha_nacimiento;
          empleados.id_puesto=respuesta.id_puesto;
        }
      });
      abrirCerarModalEditar();
    }).catch(error=>{
      console.log(error);
    })

  }

  const peticionDelete=async()=>{
    await axios.delete(baseUrl+"/"+empleadoSeleccionado.id)
    .then(response=>{
     setData(data.filter(empleados=>empleados.id!==response.data));
      abrirCerarModalEliminar();
    }).catch(error=>{
      console.log(error);
    })

  }


  const seleccionarEmpleado =(empleados, caso)=>{
    setEmpleadoSeleccionado(empleados);
    (caso==="Editar")?
    abrirCerarModalEditar(): abrirCerarModalEliminar();
  }

  useEffect(()=>{
    peticionGet();
  },[])

  return (
    <div className="App">
      <br/><br/>
      <button onClick={()=>abrirCerarModalInsertar()} className ="btn btn-success"> Insertar Nuevo Empleado </button>
      <br/><br/>
      <table className ="table table-bordered">
        <thead>
          <tr>
              <th>Id</th>
              <th>Codigo</th>
              <th>Nombres</th>
              <th>Apellidos</th>
              <th>Direccion</th>
              <th>Telefonos</th>
              <th>Nacimiento</th>
              <th>Puestos</th>
              <th>Acciones</th>
          </tr>
        </thead>
        <tbody>
          {data.map(empleados=>(
            <tr key={empleados.id}>
              <td>{empleados.id}</td>
              <td>{empleados.codigo}</td>
              <td>{empleados.nombres}</td>
              <td>{empleados.apellidos}</td>
              <td>{empleados.direccion}</td>
              <td>{empleados.telefono}</td>
              <td>{empleados.fecha_nacimiento}</td>
              <td>{empleados.id_puesto}</td>
              
              <td>
                <button className ="btn btn-primary" onClick={()=>seleccionarEmpleado(empleados,"Editar")}>Editar</button>{" "}
                <button className ="btn btn-danger" onClick={()=>seleccionarEmpleado(empleados,"Eliminar")}>Eliminar</button>
              </td>
            </tr>
          ))}
        </tbody>

      </table>

      <Modal isOpen={modalInsertar}>
      <ModalHeader>Agregar Nuevo Registro</ModalHeader>
      <ModalBody>
        <div className = "form-group">
          <label>Codigo: </label>
          <br />
          <input type="text"className ="form-control" name = "codigo" placeholder="Codigo: E001" onChange={handleChange}/> 
          <br />
          <label>Nombres: </label>
          <br />
          <input type="text"className ="form-control" name = "nombres" placeholder="Nombres: Nombre 1 Nombre 2" onChange={handleChange}/>
          <br />
          <label>Apellidos: </label>
          <br />
          <input type="text"className ="form-control" name = "apellidos" placeholder="Apellidos: Apellido 1 Apellido 2 " onChange={handleChange}/>
          <br />
          <label>Direccion: </label>
          <br />
          <input type="text"className ="form-control" name = "direccion" placeholder="Direccion: #casa calle avenida lugar location " onChange={handleChange}/>
          <br />
          <label>Telefonos: </label>
          <br />
          <input type="text"className ="form-control" name = "telefono" placeholder="Telefono: 58565452" onChange={handleChange}/>
          <br />
          <label>Fecha de Nacimiento: </label>
          <br />
          <input type="text"className ="form-control" name = "fecha_nacimiento" placeholder="aaaa-mm-dd" onChange={handleChange}/>
          <br />
          <label>Puesto: </label>
          <br />
          <input type="text"className ="form-control" name = "id_puesto" placeholder="1=Jefe 2=Programador 3=Desarrolador 4=Analista 5=Secretaria" onChange={handleChange}/>
          <br />
        </div>
      </ModalBody>
      <ModalFooter>
      <button className ="btn btn-primary" onClick={()=>peticionPost()}>Agregar</button>{" "}
      <button className ="btn btn-danger"onClick={()=>abrirCerarModalInsertar()}>Cancelar</button>
      </ModalFooter>
      </Modal>


      <Modal isOpen={modalEditar}>
      <ModalHeader>Editar Empleado</ModalHeader>
      <ModalBody>
        <div className = "form-group">
          <label>Id: </label>
          <br />
          <input type="text"className ="form-control" readOnly value ={empleadoSeleccionado && empleadoSeleccionado.id}/> 
          <br />
          <label>Codigo: </label>
          <br />
          <input type="text"className ="form-control" name = "codigo" placeholder="Codigo: E001" onChange={handleChange} value ={empleadoSeleccionado && empleadoSeleccionado.codigo}/> 
          <br />
          <label>Nombres: </label>
          <br />
          <input type="text"className ="form-control" name = "nombres" placeholder="Nombres: Nombre 1 Nombre 2" onChange={handleChange} value ={empleadoSeleccionado && empleadoSeleccionado.nombres}/>
          <br />
          <label>Apellidos: </label>
          <br />
          <input type="text"className ="form-control" name = "apellidos" placeholder="Apellidos: Apellido 1 Apellido 2 " onChange={handleChange} value ={empleadoSeleccionado && empleadoSeleccionado.apellidos}/>
          <br />
          <label>Direccion: </label>
          <br />
          <input type="text"className ="form-control" name = "direccion" placeholder="Direccion: #casa calle avenida lugar location " onChange={handleChange} value ={empleadoSeleccionado && empleadoSeleccionado.direccion}/>
          <br />
          <label>Telefonos: </label>
          <br />
          <input type="text"className ="form-control" name = "telefono" placeholder="Telefono: 58565452" onChange={handleChange} value ={empleadoSeleccionado && empleadoSeleccionado.telefono}/>
          <br />
          <label>Fecha de Nacimiento: </label>
          <br />
          <input type="text"className ="form-control" name = "fecha_nacimiento" placeholder="aaaa-mm-dd" onChange={handleChange} value ={empleadoSeleccionado && empleadoSeleccionado.fecha_nacimiento}/>
          <br />
          <label>Puesto: </label>
          <br />
          <input type="text"className ="form-control" name = "id_puesto" placeholder="1=Jefe 2=Programador 3=Desarrolador 4=Analista 5=Secretaria" onChange={handleChange} value ={empleadoSeleccionado && empleadoSeleccionado.id_puesto}/>
          <br />
        </div>
      </ModalBody>
      <ModalFooter>
      <button className ="btn btn-primary" onClick={()=>peticionPut()}>Editar</button>{" "}
      <button className ="btn btn-danger"onClick={()=>abrirCerarModalEditar()}>Cancelar</button>
      </ModalFooter>
      </Modal>


      <Modal isOpen={modalEliminar}>
          <ModalBody>
            ¿Esta seguro que desea eliminar el empleado de la base de datos {empleadoSeleccionado && empleadoSeleccionado.nombres}?
          </ModalBody>
          <ModalFooter>
            <button className ="btn btn-danger" onClick={()=>peticionDelete()}>
              si
            </button>
            <button className ="btn btn-secondary"onClick={()=>abrirCerarModalEliminar()}>
              No
            </button>
          </ModalFooter>
      </Modal>

    </div>
  );
}

export default App;
