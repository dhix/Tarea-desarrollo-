using System.ComponentModel.DataAnnotations;
namespace web_api_empresa.Models{
    public class Empleados{
        [Key]
        public int id_empleado { get; set; }
        public string codigo { get; set; }
        public string nombres { get; set; }
        public string apellidos { get; set; }
        public string direccion { get; set; }
        public string telefono { get; set; }
        public string fecha_nacimiento { get; set; }
        public int id_puesto { get; set; }
        public Puestos puesto { get; set; }
    }
}